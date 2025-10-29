<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');

Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');