<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SyncController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/sync/users', [SyncController::class, 'syncUsers']);
Route::post('/sync/categories', [SyncController::class, 'syncCategories']);
Route::post('/sync/measurements', [SyncController::class, 'syncMeasurements']);
Route::post('/sync/clients', [SyncController::class, 'syncClients']);
Route::post('/sync/commandes', [SyncController::class, 'syncCommandes']);
Route::post('/sync/mesure-clients', [SyncController::class, 'syncMesureClients']);
Route::post('/sync/associations', [SyncController::class, 'syncAssociations']);
