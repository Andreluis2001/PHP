<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $query = Livro::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('autor', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        $livros = $query->orderBy('titulo')->paginate(12);

        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'autor' => 'required|string|max:150',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0.01',
            'estoque' => 'required|integer|min:0',
            'isbn' => 'nullable|string|max:20|unique:livros,isbn',
            'imagem_capa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'autor.required' => 'O autor é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.min' => 'O preço deve ser maior que zero.',
            'estoque.required' => 'O estoque é obrigatório.',
            'estoque.min' => 'O estoque não pode ser negativo.',
            'isbn.unique' => 'Já existe um livro com esse ISBN.',
            'imagem_capa.image' => 'O arquivo deve ser uma imagem.',
            'imagem_capa.mimes' => 'A imagem deve ser PNG ou JPG.',
            'imagem_capa.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem_capa')) {
            $data['imagem_capa'] = $request->file('imagem_capa')->store('livros', 'public');
        }

        Livro::create($data);

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'autor' => 'required|string|max:150',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0.01',
            'estoque' => 'required|integer|min:0',
            'isbn' => 'nullable|string|max:20|unique:livros,isbn,' . $livro->id,
            'imagem_capa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'autor.required' => 'O autor é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.min' => 'O preço deve ser maior que zero.',
            'estoque.required' => 'O estoque é obrigatório.',
            'estoque.min' => 'O estoque não pode ser negativo.',
            'isbn.unique' => 'Já existe um livro com esse ISBN.',
            'imagem_capa.image' => 'O arquivo deve ser uma imagem.',
            'imagem_capa.mimes' => 'A imagem deve ser PNG ou JPG.',
            'imagem_capa.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem_capa')) {
            if ($livro->imagem_capa && Storage::disk('public')->exists($livro->imagem_capa)) {
                Storage::disk('public')->delete($livro->imagem_capa);
            }
            $data['imagem_capa'] = $request->file('imagem_capa')->store('livros', 'public');
        }

        $livro->update($data);

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        if ($livro->imagem_capa && Storage::disk('public')->exists($livro->imagem_capa)) {
            Storage::disk('public')->delete($livro->imagem_capa);
        }

        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}