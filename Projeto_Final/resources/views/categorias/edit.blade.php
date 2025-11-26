@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-pencil"></i> Editar Categoria</h1>
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
                <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome', $categoria->nome) }}" 
                               placeholder="Ex: Ficção, Romance, Técnico..." required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                  id="descricao" name="descricao" rows="4" 
                                  placeholder="Descreva o tipo de livros desta categoria...">{{ old('descricao', $categoria->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Opcional. Máximo de 1000 caracteres.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Atualizar Categoria
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
                <h6 class="mb-0"><i class="bi bi-info-circle"></i> Informações</h6>
            </div>
            <div class="card-body">
                <p><strong>Criada em:</strong><br>{{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última atualização:</strong><br>{{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Total de livros:</strong><br>{{ $categoria->livros()->count() }}</p>
                
                @if($categoria->livros()->count() > 0)
                    <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> Ver Livros da Categoria
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection