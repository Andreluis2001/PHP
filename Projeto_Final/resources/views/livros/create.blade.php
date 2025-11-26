@extends('layouts.app')

@section('title', 'Novo Livro')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-plus-circle"></i> Novo Livro</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informações do Livro</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título *</label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                                       id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="categoria_id" class="form-label">Categoria *</label>
                                <select class="form-select @error('categoria_id') is-invalid @enderror" 
                                        id="categoria_id" name="categoria_id" required>
                                    <option value="">Selecione...</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id', request('categoria_id')) == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor *</label>
                        <input type="text" class="form-control @error('autor') is-invalid @enderror" 
                               id="autor" name="autor" value="{{ old('autor') }}" required>
                        @error('autor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição *</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                  id="descricao" name="descricao" rows="4" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço (R$) *</label>
                                <input type="number" step="0.01" min="0.01" class="form-control @error('preco') is-invalid @enderror" 
                                       id="preco" name="preco" value="{{ old('preco') }}" required>
                                @error('preco')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="estoque" class="form-label">Estoque *</label>
                                <input type="number" min="0" class="form-control @error('estoque') is-invalid @enderror" 
                                       id="estoque" name="estoque" value="{{ old('estoque', 0) }}" required>
                                @error('estoque')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                       id="isbn" name="isbn" value="{{ old('isbn') }}">
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Imagem da Capa</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="file" class="form-control @error('imagem_capa') is-invalid @enderror" 
                               id="imagem_capa" name="imagem_capa" accept="image/png,image/jpg,image/jpeg">
                        @error('imagem_capa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Apenas PNG ou JPG. Máximo 2MB.</div>
                    </div>
                    
                    <div id="preview" style="display: none;">
                        <img id="preview-image" src="" class="img-fluid rounded" alt="Preview">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-info-circle"></i> Dicas</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="bi bi-check text-success"></i>
                            Use títulos descritivos
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check text-success"></i>
                            Categorize corretamente
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check text-success"></i>
                            Imagens melhoram a visualização
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Salvar Livro
                </button>
                <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.getElementById('imagem_capa').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection