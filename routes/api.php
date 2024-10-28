<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\SyncController;
use App\Http\Controllers\SubscriptionController;


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Routes protégées (nécessitent une authentification avec Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // Route pour la synchronisation
    Route::post('sync/store', [SyncController::class, 'store'])->name('synchroniser');

    //souscription
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
    Route::get('/subscriptions/activate', [SubscriptionController::class, 'getActiveSubscription']);
});
