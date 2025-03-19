<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AllController;
use App\Http\Controllers\TraditionnelController;
use App\Http\Controllers\ModerneController;

Route::resource('users', UserController::class);


// Routes d'administration protégées par le middleware 'auth'
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin'); // Page d'accueil de l'admin
    })->name('admin');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Gestion des produits
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});







// Routes publiques
Route::get('/', function () {
    return view('home');
})->name('home');

// Login et Inscription
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Liste des produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Formulaire d'ajout
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Enregistrer un produit
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Formulaire de modification
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Mettre à jour un produit
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Supprimer un produit

// Routes de paiement


// Panier
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Abonnement et contact
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Routes publiques
Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/new-arrivals', function () {
    return view('newArrivals');
})->name('newArrivals');
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment');

Route::get('/confirmation', [OrderController::class, 'confirmation'])->name('confirmation');


Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');

// routes/web.php
Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
// Routes de catégories
Route::get('/all', [AllController::class, 'index'])->name('all');
Route::get('/traditionnel', [TraditionnelController::class, 'index'])->name('traditionnel');
Route::get('/moderne', [ModerneController::class, 'index'])->name('moderne');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name(name: 'contact');
