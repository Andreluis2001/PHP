<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Exibir lista de categorias
     */
    public function index()
    {
        $categorias = Categoria::withCount('livros')->orderBy('nome')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulário para criar nova categoria
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Salvar nova categoria
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:categorias,nome',
            'descricao' => 'nullable|string|max:1000',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com esse nome.',
            'nome.max' => 'O nome da categoria não pode ter mais de 100 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibir detalhes da categoria
     */
    public function show(Categoria $categoria)
    {
        $categoria->load(['livros' => function($query) {
            $query->orderBy('titulo');
        }]);
        
        cookie()->queue('ultima_categoria', $categoria->id, 60 * 24 * 7);
        
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Atualizar categoria
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:categorias,nome,' . $categoria->id,
            'descricao' => 'nullable|string|max:1000',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com esse nome.',
            'nome.max' => 'O nome da categoria não pode ter mais de 100 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Excluir categoria
     */
    public function destroy(Categoria $categoria)
    {
        if ($categoria->livros()->count() > 0) {
            return redirect()->route('categorias.index')->with('error', 'Não é possível excluir uma categoria que possui livros cadastrados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}