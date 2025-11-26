@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-book"></i> Gerenciar Livros</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('livros.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Livro
        </a>
    </div>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('livros.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Título, autor ou ISBN...">
                </div>
                <div class="col-md-4">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select class="form-select" id="categoria_id" name="categoria_id">
                        <option value="">Todas as categorias</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                        <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Limpar
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if($livros->count() > 0)
    <div class="row">
        @foreach($livros as $livro)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card book-card h-100">
                @if($livro->imagem_capa)
                    <img src="{{ $livro->imagem_capa_url }}" class="card-img-top" alt="{{ $livro->titulo }}">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-book fs-1 text-muted"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-secondary mb-2 align-self-start">{{ $livro->categoria->nome }}</span>
                    <h6 class="card-title">{{ Str::limit($livro->titulo, 40) }}</h6>
                    <p class="card-text text-muted small">por {{ $livro->autor }}</p>
                    <p class="card-text">{{ Str::limit($livro->descricao, 80) }}</p>
                    
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="h6 text-success mb-0">{{ $livro->preco_formatado }}</span>
                            <small class="text-muted">Estoque: {{ $livro->estoque }}</small>
                        </div>
                        
                        @if($livro->isbn)
                            <small class="text-muted d-block">ISBN: {{ $livro->isbn }}</small>
                        @endif
                        
                        <div class="btn-group w-100 mt-2">
                            <a href="{{ route('livros.show', $livro) }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('livros.edit', $livro) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">\n                                @csrf\n                                @method('DELETE')\n                                <button type="submit" class="btn btn-outline-danger btn-sm">\n                                    <i class="bi bi-trash"></i>\n                                </button>\n                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $livros->withQueryString()->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-book fs-1 text-muted"></i>
        <h3 class="text-muted mt-3">
            @if(request('search') || request('categoria_id'))
                Nenhum livro encontrado
            @else
                Nenhum livro cadastrado
            @endif
        </h3>
        <p class="text-muted">
            @if(request('search') || request('categoria_id'))
                Tente ajustar os filtros de busca.
            @else
                Comece adicionando seu primeiro livro.
            @endif
        </p>
        @if(!request('search') && !request('categoria_id'))
            <a href="{{ route('livros.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle"></i> Adicionar Primeiro Livro
            </a>
        @endif
    </div>
@endif
@endsection