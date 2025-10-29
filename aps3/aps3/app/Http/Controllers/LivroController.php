<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autor')->get();
        $autores = Autor::all();
        return view('livros.index', compact('livros', 'autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'sinopse' => 'required',
            'ano_publicacao' => 'required|integer',
            'autor_id' => 'required|exists:autores,id'
        ]);

        Livro::create($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
    }
}