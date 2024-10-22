<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    // Méthode pour récupérer les catégories par matricule_user
    public function getCategories()
    {
        $user = Auth::user()->matricule;

        // Assurez-vous d'adapter votre logique pour filtrer les catégories selon le matricule_user
        $categories = Category::where('matricule_user', $user)->get();

        // Retourner une réponse JSON avec un code d'état 200
        return response()->json([
            'message' => 'Success', // Message de succès
            'categories' => $categories
        ], 200); // Changer 401 en 200
    }

    // Méthode pour récupérer les mesures par matricule_user
    public function getMeasurements()
    {
        $user = Auth::user()->matricule;

        // Assurez-vous d'adapter votre logique pour filtrer les mesures selon le matricule_user
        $measurements = Measurement::where('matricule_user', $user)->get();

        // Retourner une réponse JSON avec un code d'état 200
        return response()->json([
            'message' => 'Success', // Message de succès
            'measurements' => $measurements
        ], 200); // Changer 401 en 200
    }


    // Méthode pour récupérer un utilisateur par matricule
    // public function getUsers($matricule)
    // {
    //     $user = User::where('matricule', $matricule)->first();
    //     return response()->json([
    //         'message'=> 200,
    //         'user'=> $user
    //     ],401);
    // }
}
