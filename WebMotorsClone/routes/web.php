<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Página inicial com anúncios
Route::get('/', [AdController::class, 'index'])->name('ads.index');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
    Route::get('/user/ads', [AdController::class, 'userAds'])->name('ads.user_ads');
});

// Rotas de administração, protegidas pelo middleware 'IsAdmin'
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/review', [AdController::class, 'adminReview'])->name('ads.admin_review');
    Route::post('/admin/approve/{id}', [AdController::class, 'approve'])->name('ads.approve');
    Route::delete('/admin/reject/{id}', [AdController::class, 'reject'])->name('ads.reject');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
