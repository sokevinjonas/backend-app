<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Client;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Subscription;
use App\Models\Association;
use App\Models\Measurement;
use App\Models\MesureClient;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    // Mapping des tables vers les modèles correspondants
    private $tableMap = [
        'notifications' => Notification::class,
        'mesure_clients' => MesureClient::class,
        'categories' => Category::class,
        'commandes' => Commande::class,
        'clients' => Client::class,
        'subscriptions' => Subscription::class,
        'measurements' => Measurement::class,
    ];

    // Méthode principale de synchronisation
    public function synchroniser(Request $request)
    {
        try {
            // Valider les données entrantes
            $request->validate([
                'donnees' => 'required|array',
                'dernier_sync' => 'required|date'
            ]);

            // Extraire le matricule de l'utilisateur connecté
            $user = auth()->user();
            $matriculeUser = $user->matricule;
            $donnees = $request->input('donnees');
            $dernierSync = $request->input('dernier_sync');

            // Démarrer une transaction pour garantir la cohérence des données
            DB::beginTransaction();

            // Structure de la réponse à retourner
            $reponse = [
                'succes' => true,
                'modifications_serveur' => [],
                'modifications_acceptees' => [],
                'erreurs' => []
            ];

            // Traiter chaque type de données fourni par le client
            foreach ($donnees as $table => $items) {
                $resultats = $this->synchroniserTable($table, $items, $matriculeUser);
                $reponse['modifications_acceptees'][$table] = $resultats;
            }

            // Récupérer les modifications faites sur le serveur depuis le dernier sync
            $reponse['modifications_serveur'] = $this->obtenirModificationsServeur(
                $matriculeUser,
                $dernierSync
            );

            // Valider les changements
            DB::commit();

            // Retourner la réponse en JSON
            return response()->json($reponse);

        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();
            return response()->json([
                'succes' => false,
                'erreur' => $e->getMessage()
            ], 500);
        }
    }

    // Méthode pour synchroniser une table spécifique
    private function synchroniserTable($table, $items, $matriculeUser)
    {
        $resultats = [];
        $model = $this->tableMap[$table] ?? null;

        // Vérifier si le modèle de la table existe
        if (!$model) {
            return [
                'erreur' => "Table non prise en charge: $table"
            ];
        }

        foreach ($items as $item) {
            try {
                // Si l'élément n'a pas de 'id', on considère que c'est une nouvelle entrée
                if (!isset($item['id'])) {
                    // Créer une nouvelle entrée en ajoutant le matricule de l'utilisateur
                    $nouvelItem = $model::create(array_merge($item, [
                        'matricule_user' => $matriculeUser,
                        'sync_timestamp' => now()
                    ]));

                    $resultats[] = [
                        'id_local' => $item['id_local'] ?? null,
                        'id_serveur' => $nouvelItem->id,
                        'status' => 'créé'
                    ];
                } else {
                    // Mise à jour de l'élément existant
                    $existant = $model::find($item['id']);
                    if ($existant) {
                        $existant->update(array_merge($item, [
                            'sync_timestamp' => now()
                        ]));

                        $resultats[] = [
                            'id' => $item['id'],
                            'status' => 'mis à jour'
                        ];
                    } else {
                        // Si l'élément avec cet ID n'existe pas dans la base de données
                        $resultats[] = [
                            'id' => $item['id'],
                            'status' => 'non trouvé'
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Ajouter l'erreur dans les résultats pour l'élément concerné
                $resultats[] = [
                    'id' => $item['id'] ?? null,
                    'erreur' => $e->getMessage()
                ];
            }
        }

        return $resultats;
    }

    // Méthode pour obtenir les modifications du serveur depuis le dernier synchronisation
    private function obtenirModificationsServeur($matriculeUser, $dernierSync)
    {
        $modifications = [];

        // Récupérer les modifications de chaque table mappée
        foreach ($this->tableMap as $table => $model) {
            $modifications[$table] = $model::where('matricule_user', $matriculeUser)
                ->where('sync_timestamp', '>', $dernierSync)
                ->limit(100) // Limiter pour éviter les réponses volumineuses
                ->get();
        }

        return $modifications;
    }
}
