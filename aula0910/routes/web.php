<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', [TesteController::class, 'index']);

Route::get('/data', [TesteController::class, 'getData']);

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

Route::get('/produtos/criar', [ProdutoController::class, 'criar'])->name('produtos.criar');

Route::post('/produtos/salvar', [ProdutoController::class, 'salvar'])->name('produtos.salvar');


