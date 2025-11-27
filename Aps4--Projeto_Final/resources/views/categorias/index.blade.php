@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-tags"></i> Gerenciar Categorias</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('categorias.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nova Categoria
        </a>
    </div>
</div>

@if($categorias->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Qtd. Livros</th>
                            <th>Criada em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td>
                                <strong>{{ $categoria->nome }}</strong>
                            </td>
                            <td>
                                {{ Str::limit($categoria->descricao, 50) ?? 'Sem descrição' }}
                            </td>
                            <td>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $categoria->livros_count }}
                                </span>
                            </td>
                            <td>
                                {{ $categoria->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('categorias.show', $categoria) }}" 
                                       class="btn btn-sm btn-outline-info" title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('categorias.edit', $categoria) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($categoria->livros_count == 0)
                                    <form action="{{ route('categorias.destroy', $categoria) }}" 
                                          method="POST" style="display: inline;"
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    <div class="mt-3">
        {{ $categorias->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-tags fs-1 text-muted"></i>
        <h3 class="text-muted mt-3">Nenhuma categoria cadastrada</h3>
        <p class="text-muted">Comece criando sua primeira categoria de livros.</p>
        <a href="{{ route('categorias.create') }}" class="btn btn-success btn-lg">
            <i class="bi bi-plus-circle"></i> Criar Primeira Categoria
        </a>
    </div>
@endif
@endsection