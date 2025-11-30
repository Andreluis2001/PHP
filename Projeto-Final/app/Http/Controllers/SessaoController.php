<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SessaoController extends Controller
{
    public function formLogin()
    {
        return view('sessao.login');
    }

    public function login(Request $request)
    {
        $nome = $request->nome;
        session(['usuario' => $nome]);
        return redirect()->route('home');
    }

    public function home(Request $request)
    {
        $usuario = session('usuario');
        if (!$usuario) {
            return redirect()->route('login.form');
        }

        $tema = $request->cookie('tema', 'claro');
        $ultimaCategoria = $request->cookie('ultima_categoria');

        $arquivos = collect(Storage::disk('public')->files('uploads'))
                        ->map(fn($f) => asset('storage/' . $f));

        return view('sessao.home', compact('usuario', 'tema', 'arquivos', 'ultimaCategoria'));
    }

    public function logout()
    {
        session()->forget('usuario');
        return redirect()->route('login.form');
    }

    public function salvarTema(Request $request)
    {
        return back()->cookie('tema', $request->tema, 60);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $caminho = $request->file('arquivo')->store('uploads', 'public');

        return back()->with('sucesso', 'Arquivo enviado com sucesso: ' . $caminho);
    }

    public function ajaxUsuario(Request $request)
    {
        $usuario = session('usuario');

        return response()->json([
            'nome' => $usuario,
            'mensagem' => "Usuário encontrado via AJAX."
        ]);
    }
}
