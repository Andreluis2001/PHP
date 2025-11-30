<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria - Adicionar Livro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; margin-bottom: 30px; }
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
        <h1>📖 Adicionar Novo Livro</h1>
        
        <form action="{{ route('livros.salvar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                @error('titulo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="autor">Autor *</label>
                    <input type="text" id="autor" name="autor" value="{{ old('autor') }}" required>
                    @error('autor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="978-3-16-148410-0">
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
                        <option value="Ficção" {{ old('categoria') == 'Ficção' ? 'selected' : '' }}>Ficção</option>
                        <option value="Não-ficção" {{ old('categoria') == 'Não-ficção' ? 'selected' : '' }}>Não-ficção</option>
                        <option value="Romance" {{ old('categoria') == 'Romance' ? 'selected' : '' }}>Romance</option>
                        <option value="Mistério" {{ old('categoria') == 'Mistério' ? 'selected' : '' }}>Mistério</option>
                        <option value="Fantasia" {{ old('categoria') == 'Fantasia' ? 'selected' : '' }}>Fantasia</option>
                        <option value="Biografia" {{ old('categoria') == 'Biografia' ? 'selected' : '' }}>Biografia</option>
                        <option value="História" {{ old('categoria') == 'História' ? 'selected' : '' }}>História</option>
                        <option value="Ciência" {{ old('categoria') == 'Ciência' ? 'selected' : '' }}>Ciência</option>
                        <option value="Tecnologia" {{ old('categoria') == 'Tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                        <option value="Autoajuda" {{ old('categoria') == 'Autoajuda' ? 'selected' : '' }}>Autoajuda</option>
                    </select>
                    @error('categoria')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" id="preco" name="preco" value="{{ old('preco') }}" step="0.01" min="0" required>
                    @error('preco')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="estoque">Quantidade em Estoque *</label>
                <input type="number" id="estoque" name="estoque" value="{{ old('estoque', 1) }}" min="0" required>
                @error('estoque')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descreva o livro...">{{ old('descricao') }}</textarea>
                @error('descricao')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagem">Capa do Livro</label>
                <input type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg">
                <div class="file-info">Formatos aceitos: PNG, JPG, JPEG. Tamanho máximo: 2MB</div>
                @error('imagem')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-success">💾 Salvar Livro</button>
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>