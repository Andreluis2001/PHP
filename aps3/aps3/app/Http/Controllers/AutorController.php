<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'nacionalidade' => 'required',
            'data_nascimento' => 'required|date'
        ]);

        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor cadastrado com sucesso!');
    }
}