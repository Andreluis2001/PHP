<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar {{ $livro->titulo }} - Livraria</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; margin-bottom: 30px; }
        .current-image { margin-bottom: 15px; }
        .current-image img { width: 100px; height: 140px; object-fit: cover; border-radius: 4px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #007bff; box-shadow: 0 0 0 2px rgba(0,123,255,.25); }
        textarea { height: 100px; resize: vertical; }
        .btn { display: inline-block; padding: 12px 20px; margin: 10px 5px 0 0; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn:hover { opacity: 0.8; }
        .error-message { color: #dc3545; font-size: 12px; margin-top: 5px; }
        .file-info { font-size: 12px; color: #666; margin-top: 5px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Livro</h1>
        
        <form action="{{ route('livros.atualizar', $livro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $livro->titulo) }}" required>
                @error('titulo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="autor">Autor *</label>
                    <input type="text" id="autor" name="autor" value="{{ old('autor', $livro->autor) }}" required>
                    @error('autor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $livro->isbn) }}" placeholder="978-3-16-148410-0">
                    @error('isbn')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="categoria">Categoria *</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="Ficção" {{ old('categoria', $livro->categoria) == 'Ficção' ? 'selected' : '' }}>Ficção</option>
                        <option value="Não-ficção" {{ old('categoria', $livro->categoria) == 'Não-ficção' ? 'selected' : '' }}>Não-ficção</option>
                        <option value="Romance" {{ old('categoria', $livro->categoria) == 'Romance' ? 'selected' : '' }}>Romance</option>
                        <option value="Mistério" {{ old('categoria', $livro->categoria) == 'Mistério' ? 'selected' : '' }}>Mistério</option>
                        <option value="Fantasia" {{ old('categoria', $livro->categoria) == 'Fantasia' ? 'selected' : '' }}>Fantasia</option>
                        <option value="Biografia" {{ old('categoria', $livro->categoria) == 'Biografia' ? 'selected' : '' }}>Biografia</option>
                        <option value="História" {{ old('categoria', $livro->categoria) == 'História' ? 'selected' : '' }}>História</option>
                        <option value="Ciência" {{ old('categoria', $livro->categoria) == 'Ciência' ? 'selected' : '' }}>Ciência</option>
                        <option value="Tecnologia" {{ old('categoria', $livro->categoria) == 'Tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                        <option value="Autoajuda" {{ old('categoria', $livro->categoria) == 'Autoajuda' ? 'selected' : '' }}>Autoajuda</option>
                    </select>
                    @error('categoria')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" id="preco" name="preco" value="{{ old('preco', $livro->preco) }}" step="0.01" min="0" required>
                    @error('preco')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="estoque">Quantidade em Estoque *</label>
                <input type="number" id="estoque" name="estoque" value="{{ old('estoque', $livro->estoque) }}" min="0" required>
                @error('estoque')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descreva o livro...">{{ old('descricao', $livro->descricao) }}</textarea>
                @error('descricao')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagem">Capa do Livro</label>
                @if($livro->imagem)
                    <div class="current-image">
                        <p>Imagem atual:</p>
                        <img src="{{ asset('storage/uploads/' . $livro->imagem) }}" alt="{{ $livro->titulo }}">
                    </div>
                @endif
                <input type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg">
                <div class="file-info">
                    Formatos aceitos: PNG, JPG, JPEG. Tamanho máximo: 2MB
                    @if($livro->imagem)
                        <br>Deixe em branco para manter a imagem atual.
                    @endif
                </div>
                @error('imagem')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-success">💾 Atualizar Livro</button>
                <a href="{{ route('livros.mostrar', $livro->id) }}" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>