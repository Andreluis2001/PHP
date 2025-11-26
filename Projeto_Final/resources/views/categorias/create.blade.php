@extends('layouts.app')

@section('title', 'Nova Categoria')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-plus-circle"></i> Nova Categoria</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informações da Categoria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome') }}" 
                               placeholder="Ex: Ficção, Romance, Técnico..." required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                  id="descricao" name="descricao" rows="4" 
                                  placeholder="Descreva o tipo de livros desta categoria...">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Opcional. Máximo de 1000 caracteres.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Salvar Categoria
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle"></i> Dicas</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check text-success"></i>
                        Use nomes descritivos e únicos
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check text-success"></i>
                        A descrição ajuda na organização
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check text-success"></i>
                        Categorias facilitam a busca de livros
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection