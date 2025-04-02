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
// web.php
use App\Http\Controllers\OrderTrackingController;


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



Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');

// routes/web.php
Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
// Routes de catégories
Route::get('/all', [AllController::class, 'index'])->name('all');
Route::get('/traditionnel', [TraditionnelController::class, 'index'])->name('traditionnel');
Route::get('/moderne', [ModerneController::class, 'index'])->name('moderne');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name(name: 'contact');



// Routes pour la gestion des commandes
Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/order/confirmation/{orderId}', [OrderController::class, 'confirmation'])->name('order.confirmation');
Route::get('/order/payment/{orderId}', [OrderController::class, 'payment'])->name('order.payment');
Route::post('/order/update-status/{orderId}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
Route::get('/order/update-payment-status/{orderId}', [OrderController::class, 'updatePaymentStatus'])->name('order.updatePaymentStatus');

// Route pour afficher la page de checkout
Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('order.checkout');

// Routes pour l'administration des commandes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/order/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::middleware('auth')->get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.myOrders');
// Route pour afficher la page de succès du paiement
Route::get('/order/{orderId}/payment-success', [OrderController::class, 'paymentSuccess'])->name('payment-success');

Route::match(['get', 'post'], '/order/{orderId}/payment', [OrderController::class, 'payment'])->name('payment');
// Route pour annuler une commande
Route::post('/order/{orderId}/cancel', [OrderController::class, 'cancel'])->name('cancel');
// Route pour afficher la confirmation d'annulation
Route::get('/order/{orderId}/payment-cancel', [OrderController::class, 'paymentCancel'])->name('payment-cancel');
