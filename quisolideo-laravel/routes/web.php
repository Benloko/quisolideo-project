<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Trainings routes removed — page will be recreated from scratch on request
// Recreate trainings listing (clean)
Route::get('/formations', [TrainingController::class, 'index'])->name('trainings.index');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'doLogin'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    if (!session()->has('admin_id')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

// Simple gallery page (shows images from public/assets/gallery)
Route::get('/galerie', function () {
    return view('galerie');
})->name('gallery');

// Admin CRUD routes for trainings & partners (session-protected)
use App\Http\Controllers\AdminTrainingController;
use App\Http\Controllers\AdminPartnerController;
use App\Http\Middleware\EnsureAdmin;

Route::prefix('admin')->middleware(EnsureAdmin::class)->group(function () {
    Route::resource('trainings', AdminTrainingController::class, ['as'=>'admin'])->except(['show']);
    Route::resource('partners', AdminPartnerController::class, ['as'=>'admin'])->except(['show']);
});
