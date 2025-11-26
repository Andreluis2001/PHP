@extends('layouts.app')

@section('title', $categoria->nome)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-tag"></i> {{ $categoria->nome }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group">
            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Informações da Categoria</h5>
            </div>
            <div class="card-body">
                <h4>{{ $categoria->nome }}</h4>
                @if($categoria->descricao)
                    <p class="text-muted">{{ $categoria->descricao }}</p>
                @else
                    <p class="text-muted fst-italic">Sem descrição</p>
                @endif
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Total de livros:</strong> {{ $categoria->livros->count() }}</p>
                        <p><strong>Criada em:</strong> {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Última atualização:</strong> {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Livros desta Categoria -->
        @if($categoria->livros->count() > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Livros desta Categoria</h5>
                <a href="{{ route('livros.create') }}?categoria_id={{ $categoria->id }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus"></i> Novo Livro
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($categoria->livros as $livro)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card book-card h-100">
                            @if($livro->imagem_capa)
                                <img src="{{ $livro->imagem_capa_url }}" class="card-img-top" alt="{{ $livro->titulo }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-book fs-1 text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ Str::limit($livro->titulo, 50) }}</h6>
                                <p class="card-text text-muted small">por {{ $livro->autor }}</p>
                                <p class="card-text">{{ Str::limit($livro->descricao, 80) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h6 text-success">{{ $livro->preco_formatado }}</span>
                                        <small class="text-muted">Estoque: {{ $livro->estoque }}</small>
                                    </div>
                                    <div class="btn-group w-100 mt-2">
                                        <a href="{{ route('livros.show', $livro) }}" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-book fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Nenhum livro nesta categoria</h5>
                <p class="text-muted">Adicione livros para organizar seu acervo.</p>
                <a href="{{ route('livros.create') }}?categoria_id={{ $categoria->id }}" class="btn btn-success">
                    <i class="bi bi-plus"></i> Adicionar Livro
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-gear"></i> Ações</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar Categoria
                    </a>
                    <a href="{{ route('livros.create') }}?categoria_id={{ $categoria->id }}" class="btn btn-success">
                        <i class="bi bi-plus"></i> Novo Livro
                    </a>
                    <a href="{{ route('livros.index') }}?categoria_id={{ $categoria->id }}" class="btn btn-info">
                        <i class="bi bi-filter"></i> Filtrar Livros
                    </a>
                    @if($categoria->livros->count() == 0)
                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> Excluir Categoria
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Estatísticas</h6>
            </div>
            <div class="card-body">
                <p><strong>Total de livros:</strong><br>{{ $categoria->livros->count() }}</p>
                @if($categoria->livros->count() > 0)
                <p><strong>Valor médio:</strong><br>R$ {{ number_format($categoria->livros->avg('preco'), 2, ',', '.') }}</p>
                <p><strong>Total em estoque:</strong><br>{{ $categoria->livros->sum('estoque') }} unidades</p>
                <p><strong>Valor do estoque:</strong><br>R$ {{ number_format($categoria->livros->sum(function($livro) { return $livro->preco * $livro->estoque; }), 2, ',', '.') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection