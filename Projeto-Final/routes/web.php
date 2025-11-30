<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\SessaoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [SessaoController::class, 'formLogin'])->name('login.form');
Route::post('/login', [SessaoController::class, 'login'])->name('login');
Route::get('/home', [SessaoController::class, 'home'])->name('home');
Route::get('/logout', [SessaoController::class, 'logout'])->name('logout');

Route::get('/ajax/usuario', [SessaoController::class, 'ajaxUsuario'])->name('ajax.usuario');

Route::post('/tema', [SessaoController::class, 'salvarTema'])->name('tema.salvar');
Route::post('/upload', [SessaoController::class, 'upload'])->name('arquivo.upload');

Route::get('/teste', [TesteController::class, 'index']);
Route::get('/testeData', [TesteController::class, 'retornaData']);

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::get('/livros/criar', [LivroController::class, 'criar'])->name('livros.criar');
Route::post('/livros', [LivroController::class, 'salvar'])->name('livros.salvar');
Route::get('/livros/{id}', [LivroController::class, 'mostrar'])->name('livros.mostrar');
Route::get('/livros/{id}/editar', [LivroController::class, 'editar'])->name('livros.editar');
Route::put('/livros/{id}', [LivroController::class, 'atualizar'])->name('livros.atualizar');
Route::delete('/livros/{id}', [LivroController::class, 'excluir'])->name('livros.excluir');

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/criar', [ProdutoController::class, 'criar'])->name('produtos.criar');
Route::post('/produtos', [ProdutoController::class, 'salvar'])->name('produtos.salvar');