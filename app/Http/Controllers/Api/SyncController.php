<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Client;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Measurement;
use App\Models\MesureClient;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    private $tableMap = [
        'users' => User::class,
        'notifications' => Notification::class,
        'mesure_clients' => MesureClient::class,
        'commandes' => Commande::class,
        'clients' => Client::class
    ];

    public function synchroniser(Request $request)
    {
        try {
            DB::beginTransaction();

            $matriculeUser = $request->input('matricule_user');
            $donnees = $request->input('donnees');
            $dernierSync = $request->input('dernier_sync');

            $reponse = [
                'succes' => true,
                'modifications_serveur' => [],
                'modifications_acceptees' => [],
                'erreurs' => []
            ];

            // Traiter chaque type de données
            foreach ($donnees as $table => $items) {
                $resultats = $this->synchroniserTable($table, $items, $matriculeUser);
                $reponse['modifications_acceptees'][$table] = $resultats;
            }

            // Récupérer les modifications du serveur
            $reponse['modifications_serveur'] = $this->obtenirModificationsServeur(
                $matriculeUser,
                $dernierSync
            );

            DB::commit();
            return response()->json($reponse);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'succes' => false,
                'erreur' => $e->getMessage()
            ], 500);
        }
    }

    private function synchroniserTable($table, $items, $matriculeUser)
    {
        $resultats = [];
        $model = $this->tableMap[$table];

        foreach ($items as $item) {
            try {
                if (!isset($item['id'])) {
                    // Nouvelle entrée
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
                    // Mise à jour
                    $existant = $model::find($item['id']);
                    if ($existant) {
                        $existant->update(array_merge($item, [
                            'sync_timestamp' => now()
                        ]));
                        $resultats[] = [
                            'id' => $item['id'],
                            'status' => 'mis à jour'
                        ];
                    }
                }
            } catch (\Exception $e) {
                $resultats[] = [
                    'id' => $item['id'] ?? null,
                    'erreur' => $e->getMessage()
                ];
            }
        }

        return $resultats;
    }

    private function obtenirModificationsServeur($matriculeUser, $dernierSync)
    {
        $modifications = [];

        foreach ($this->tableMap as $table => $model) {
            $modifications[$table] = $model::where('matricule_user', $matriculeUser)
                ->where('sync_timestamp', '>', $dernierSync)
                ->get();
        }

        return $modifications;
    }
}
