<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/producten/drinken', function () {
    $drinken = [
        ['naam' => 'Cola', 'prijs' => '€1,50', 'afbeelding' => 'https://via.placeholder.com/150?text=Cola'],
        ['naam' => 'Fanta', 'prijs' => '€1,40', 'afbeelding' => 'https://via.placeholder.com/150?text=Fanta'],
        ['naam' => 'Sprite', 'prijs' => '€1,30', 'afbeelding' => 'https://via.placeholder.com/150?text=Sprite'],
        ['naam' => 'icedtea', 'prijs' => '€1,50', 'afbeelding' => 'https://via.placeholder.com/150?text=Cola'],
    ];
    return view('producten.drinken', compact('drinken'));
})->name('producten.drinken');

// Verwijder deze statische winkelwagen route!
// Route::get('/winkelwagen', function () { ... });

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.removeItem');
