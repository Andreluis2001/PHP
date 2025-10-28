<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Produtos', [ProdutoController::class, 'index'])->name('produtos.index');

Route::get('/Categorias', [CategoriaController::class, 'index'])->name('categorias.index');

Route::post('/Produtos', [ProdutoController::class, 'store'])->name('produtos.store');

Route::post('/Categorias', [CategoriaController::class, 'store'])->name('categorias.store');