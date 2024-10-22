<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SyncController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Routes protégées (nécessitent une authentification avec Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sync/users', [SyncController::class, 'syncUsers']);
    Route::post('/sync/categories', [SyncController::class, 'syncCategories']);
    Route::post('/sync/measurements', [SyncController::class, 'syncMeasurements']);
    Route::delete('/sync/measurements/{matricule_user}', [SyncController::class, 'deleteMeasurement']);
    Route::post('/sync/clients', [SyncController::class, 'syncClients']);
    Route::post('/sync/commandes', [SyncController::class, 'syncCommandes']);
    Route::post('/sync/mesure-clients', [SyncController::class, 'syncMesureClients']);
    Route::post('/sync/associations', [SyncController::class, 'syncAssociations']);

    //Fetching des donnees
    Route::get('/categories', [DataController::class, 'getCategories']);
    Route::get('/measurements', [DataController::class, 'getMeasurements']);
    // Route::get('/users', [DataController::class, 'getUsers']);
});
