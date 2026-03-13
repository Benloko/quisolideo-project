<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/partners', [PagesController::class, 'partners'])->name('partners.index');

Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'contactSubmit'])->name('contact.submit');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

// Boutique (MVP)
Route::get('/boutique', [ShopController::class, 'index'])->name('shop.index');
Route::get('/boutique/panier', [CartController::class, 'show'])->name('cart.show');
Route::post('/boutique/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::post('/boutique/panier', [CartController::class, 'update'])->name('cart.update');
Route::post('/boutique/panier/supprimer', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/boutique/panier/vider', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/boutique/commande', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/boutique/commande', [CheckoutController::class, 'place'])->name('checkout.place');
Route::get('/boutique/paiement/stripe/succes', [CheckoutController::class, 'stripeSuccess'])->name('checkout.stripe.success');
Route::get('/boutique/paiement/stripe/annule', [CheckoutController::class, 'stripeCancel'])->name('checkout.stripe.cancel');
Route::post('/stripe/webhook', [CheckoutController::class, 'stripeWebhook'])->name('stripe.webhook');
Route::get('/boutique/merci', [CheckoutController::class, 'thankyou'])->name('shop.thankyou');
Route::get('/boutique/produit/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/mentions', [PagesController::class, 'mentions'])->name('mentions');
Route::get('/politique', [PagesController::class, 'politique'])->name('politique');

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
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Middleware\EnsureAdmin;

Route::prefix('admin')->middleware(EnsureAdmin::class)->group(function () {
    Route::resource('trainings', AdminTrainingController::class, ['as'=>'admin'])->except(['show']);
    Route::resource('partners', AdminPartnerController::class, ['as'=>'admin'])->except(['show']);

    Route::resource('products', AdminProductController::class, ['as'=>'admin'])->except(['show']);
    Route::resource('orders', AdminOrderController::class, ['as'=>'admin'])->only(['index', 'show', 'update']);

    Route::get('messages', [AdminContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::patch('messages/{message}/toggle-read', [AdminContactMessageController::class, 'toggleRead'])->name('admin.messages.toggleRead');
    Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
});
