@extends('layouts.app')

@section('title', $livro->titulo)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-book"></i> {{ $livro->titulo }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('livros.edit', $livro) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                @if($livro->imagem_capa)
                    <img src="{{ $livro->imagem_capa_url }}" class="img-fluid rounded" alt="{{ $livro->titulo }}">
                @else
                    <div class="bg-light p-5 rounded mb-3">
                        <i class="bi bi-book display-1 text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Detalhes do Livro</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Título:</dt>
                    <dd class="col-sm-9">{{ $livro->titulo }}</dd>
                    
                    <dt class="col-sm-3">Autor:</dt>
                    <dd class="col-sm-9">{{ $livro->autor }}</dd>
                    
                    <dt class="col-sm-3">Descrição:</dt>
                    <dd class="col-sm-9">{{ $livro->descricao }}</dd>
                    
                    <dt class="col-sm-3">Preço:</dt>
                    <dd class="col-sm-9"><span class="text-success h5">{{ $livro->preco_formatado }}</span></dd>
                    
                    <dt class="col-sm-3">Estoque:</dt>
                    <dd class="col-sm-9">
                        <span class="badge {{ $livro->estoque > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $livro->estoque }} {{ $livro->estoque == 1 ? 'unidade' : 'unidades' }}
                        </span>
                    </dd>
                    
                    @if($livro->isbn)
                    <dt class="col-sm-3">ISBN:</dt>
                    <dd class="col-sm-9">{{ $livro->isbn }}</dd>
                    @endif
                    
                    <dt class="col-sm-3">Criado em:</dt>
                    <dd class="col-sm-9">{{ $livro->created_at->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-3">Atualizado em:</dt>
                    <dd class="col-sm-9">{{ $livro->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Ações</h6>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="{{ route('livros.edit', $livro) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar Livro
                    </a>
                    <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection