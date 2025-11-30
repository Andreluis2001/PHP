<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->get('categoria');
        
        if ($categoria) {
            $livros = Livro::where('categoria', $categoria)->get();
            setcookie('ultima_categoria', $categoria, time() + (86400 * 30), '/');
        } else {
            $livros = Livro::all();
        }

        $categorias = Livro::distinct()->pluck('categoria');
        $ultimaCategoria = $_COOKIE['ultima_categoria'] ?? null;

        return view('livros.index', compact('livros', 'categorias', 'ultimaCategoria'));
    }

    public function criar()
    {
        return view('livros.criar');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:2|max:255',
            'autor' => 'required|min:2|max:255',
            'isbn' => 'nullable|unique:livros|max:20',
            'categoria' => 'required|max:100',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'descricao' => 'nullable|max:1000',
            'imagem' => 'nullable|image|mimes:png,jpg|max:2048'
        ]);

        $dados = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem');
            $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('storage/uploads'), $nomeArquivo);
            $dados['imagem'] = $nomeArquivo;
        }

        Livro::create($dados);

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function mostrar($id)
    {
        $livro = Livro::findOrFail($id);
        return view('livros.mostrar', compact('livro'));
    }

    public function editar($id)
    {
        $livro = Livro::findOrFail($id);
        return view('livros.editar', compact('livro'));
    }

    public function atualizar(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        $request->validate([
            'titulo' => 'required|min:2|max:255',
            'autor' => 'required|min:2|max:255',
            'isbn' => 'nullable|max:20|unique:livros,isbn,' . $id,
            'categoria' => 'required|max:100',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'descricao' => 'nullable|max:1000',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $dados = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            if ($livro->imagem && file_exists(public_path('storage/uploads/' . $livro->imagem))) {
                unlink(public_path('storage/uploads/' . $livro->imagem));
            }

            $arquivo = $request->file('imagem');
            $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('storage/uploads'), $nomeArquivo);
            $dados['imagem'] = $nomeArquivo;
        }

        $livro->update($dados);

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function excluir($id)
    {
        $livro = Livro::findOrFail($id);

        if ($livro->imagem && file_exists(public_path('storage/uploads/' . $livro->imagem))) {
            unlink(public_path('storage/uploads/' . $livro->imagem));
        }

        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}