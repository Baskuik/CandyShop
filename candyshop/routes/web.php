<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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
