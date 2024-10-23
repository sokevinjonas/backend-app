<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscriptions/search', [SubscriptionController::class, 'showSearchForm'])->name('subscriptions.search');
Route::post('/subscriptions/search', [SubscriptionController::class, 'search'])->name('subscriptions.search.result');
Route::post('/subscriptions/activate/{id}', [SubscriptionController::class, 'activate'])->name('subscriptions.activate');
Route::post('/subscriptions/cancel/{id}', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

