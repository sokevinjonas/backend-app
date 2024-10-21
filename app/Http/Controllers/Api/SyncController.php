<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use App\Models\Measurement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
     // Synchroniser les utilisateurs
     public function syncUsers(Request $request)
     {
         $validatedData = $request->validate([
             'users' => 'required|array',
         ]);

         foreach ($validatedData['users'] as $userData) {
             User::updateOrCreate(
                 ['matricule' => $userData['matricule']],
                 $userData
             );
         }

         return response()->json(['message' => 'Users synchronized successfully.']);
     }

     // Synchroniser les catégories
     public function syncCategories(Request $request)
    {
        // Validation des données reçues
        $validatedData = $request->validate([
            'categories' => 'required|array',
        ]);

        foreach ($validatedData['categories'] as $categoryData) {
            // Vérifiez si le matricule_user existe dans la table users
            $userExists = User::where('matricule', $categoryData['matricule_user'])->exists();

            if ($userExists) {
                // Vérifiez si une catégorie avec le même label et matricule_user existe déjà
                $category = Category::where('matricule_user', $categoryData['matricule_user'])
                    ->where('label', $categoryData['label'])
                    ->first();

                if ($category) {
                    // Mettre à jour la catégorie existante
                    $category->update([
                        'label' => $categoryData['label'], // Si vous voulez mettre à jour d'autres champs, ajoutez-les ici
                    ]);
                } else {
                    // Créer une nouvelle catégorie
                    Category::create([
                        'matricule_user' => $categoryData['matricule_user'],
                        'label' => $categoryData['label'],
                    ]);
                }
            } else {
                return response()->json(['message' => "L'utilisateur avec le matricule {$categoryData['matricule_user']} n'existe pas."], 404);
            }
        }

        // Réponse en JSON pour indiquer la réussite de l'opération
        return response()->json(['message' => 'Categories synchronized successfully.']);
    }


    public function syncMeasurements(Request $request)
    {
        // Validation des données reçues
        $validatedData = $request->validate([
            'measurements' => 'required|array',
        ]);

        foreach ($validatedData['measurements'] as $measurementData) {
            // Vérifiez si le matricule_user existe dans la table users
            $userExists = User::where('matricule', $measurementData['matricule_user'])->exists();

            if ($userExists) {
                // Trouvez la mesure avec le même matricule_user et label
                $measurement = Measurement::where('matricule_user', $measurementData['matricule_user'])
                    ->where('label', $measurementData['label'])
                    ->where('category', $measurementData['category'])
                    ->first();

                if ($measurement) {
                    // Mettre à jour la mesure si elle existe
                    $measurement->update([
                        'category' => $measurementData['category'],
                        'label' => $measurementData['label'],
                    ]);
                } else {
                    // Créer une nouvelle mesure si elle n'existe pas
                    Measurement::create([
                        'matricule_user' => $measurementData['matricule_user'],
                        'category' => $measurementData['category'],
                        'label' => $measurementData['label'],
                    ]);
                }
            } else {
                return response()->json(['message' => "L'utilisateur avec le matricule {$measurementData['matricule_user']} n'existe pas."], 404);
            }
        }

        // Réponse en JSON pour indiquer la réussite de l'opération
        return response()->json(['message' => 'Measurements synchronized successfully.']);
    }

    // public function deleteMeasurement(Request $request, $matricule_user)
    // {
    //     $label = $request->query('label');
    //     $category = $request->query('category');

    //     // Logique pour supprimer la mesure, en fonction de label et category
    //     $measurement = Measurement::where('matricule_user', $matricule_user)
    //         ->where('label', $label)
    //         ->where('category', $category)
    //         ->first();

    //     if ($measurement) {
    //         $measurement->delete();
    //         return response()->json(['message' => 'Mesure supprimée avec succès.'], 200);
    //     }

    //     return response()->json(['message' => 'Mesure non trouvée.'], 404);
    // }


}
