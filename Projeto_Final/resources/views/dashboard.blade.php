@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-speedometer2"></i> Dashboard</h1>
</div>

@if($ultimaCategoria)
<div class="alert alert-info">
    <i class="bi bi-info-circle"></i> 
    Última categoria visualizada: <strong>{{ $ultimaCategoria->nome }}</strong>
    <a href="{{ route('categorias.show', $ultimaCategoria) }}" class="btn btn-sm btn-outline-primary ms-2">
        Ver categoria
    </a>
</div>
@endif

<!-- Cards de estatísticas -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total de Livros
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLivros }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Categorias
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategorias }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-tags fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Valor Total do Estoque
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            R$ {{ number_format($valorTotalEstoque, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-dollar fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Bem-vindo
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-circle fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Livros Recentes -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-clock"></i> Livros Adicionados Recentemente
                </h6>
            </div>
            <div class="card-body">
                @if($livrosRecentes->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($livrosRecentes as $livro)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $livro->titulo }}</h6>
                                <p class="mb-1">por {{ $livro->autor }}</p>
                                <small class="text-muted">{{ $livro->categoria->nome }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary rounded-pill">{{ $livro->preco_formatado }}</span>
                                <br>
                                <small class="text-muted">{{ $livro->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('livros.index') }}" class="btn btn-primary">
                            Ver todos os livros
                        </a>
                    </div>
                @else
                    <p class="text-muted text-center">Nenhum livro cadastrado ainda.</p>
                    <div class="text-center">
                        <a href="{{ route('livros.create') }}" class="btn btn-success">
                            <i class="bi bi-plus"></i> Adicionar primeiro livro
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Categorias Populares -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-star"></i> Categorias Mais Populares
                </h6>
            </div>
            <div class="card-body">
                @if($categoriasPopulares->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($categoriasPopulares as $categoria)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $categoria->nome }}</h6>
                                @if($categoria->descricao)
                                    <p class="mb-1 text-muted">{{ Str::limit($categoria->descricao, 50) }}</p>
                                @endif
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success rounded-pill">
                                    {{ $categoria->livros_count }} 
                                    {{ $categoria->livros_count == 1 ? 'livro' : 'livros' }}
                                </span>
                                <br>
                                <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-outline-primary mt-1">
                                    Ver
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('categorias.index') }}" class="btn btn-primary">
                            Ver todas as categorias
                        </a>
                    </div>
                @else
                    <p class="text-muted text-center">Nenhuma categoria cadastrada ainda.</p>
                    <div class="text-center">
                        <a href="{{ route('categorias.create') }}" class="btn btn-success">
                            <i class="bi bi-plus"></i> Criar primeira categoria
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Ações Rápidas -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-lightning"></i> Ações Rápidas
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('livros.create') }}" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i><br>
                            Adicionar Livro
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('categorias.create') }}" class="btn btn-info w-100">
                            <i class="bi bi-tag"></i><br>
                            Nova Categoria
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('livros.index') }}" class="btn btn-primary w-100">
                            <i class="bi bi-list"></i><br>
                            Listar Livros
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-tags"></i><br>
                            Gerenciar Categorias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection