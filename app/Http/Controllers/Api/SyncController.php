<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
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
         $validatedData = $request->validate([
             'categories' => 'required|array',
         ]);

         foreach ($validatedData['categories'] as $categoryData) {
             Category::updateOrCreate(
                 ['id' => $categoryData['id']],
                 $categoryData
             );
         }

         return response()->json(['message' => 'Categories synchronized successfully.']);
     }
}
