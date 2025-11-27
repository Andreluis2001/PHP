<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalLivros = Livro::count();
        $totalCategorias = Categoria::count();
        $valorTotalEstoque = Livro::sum(DB::raw('preco * estoque'));
        
        $livrosRecentes = Livro::with('categoria')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $categoriasPopulares = Categoria::withCount('livros')
            ->orderBy('livros_count', 'desc')
            ->limit(5)
            ->get();

        $ultimaCategoria = null;
        if ($request->cookie('ultima_categoria')) {
            $ultimaCategoria = Categoria::find($request->cookie('ultima_categoria'));
        }

        return view('dashboard', compact(
            'totalLivros',
            'totalCategorias', 
            'valorTotalEstoque',
            'livrosRecentes',
            'categoriasPopulares',
            'ultimaCategoria'
        ));
    }
}