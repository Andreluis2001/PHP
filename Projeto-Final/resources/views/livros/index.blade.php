<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria - Lista de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .btn { display: inline-block; padding: 10px 15px; margin: 5px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn:hover { opacity: 0.8; }
        .livro-card { border: 1px solid #ddd; margin-bottom: 20px; padding: 15px; border-radius: 8px; display: flex; gap: 15px; }
        .livro-imagem { width: 100px; height: 140px; object-fit: cover; border-radius: 4px; }
        .livro-info { flex: 1; }
        .livro-titulo { font-size: 18px; font-weight: bold; color: #333; margin-bottom: 5px; }
        .livro-autor { color: #666; margin-bottom: 5px; }
        .livro-preco { font-size: 20px; font-weight: bold; color: #28a745; margin-bottom: 10px; }
        .livro-categoria { background-color: #e9ecef; padding: 5px 10px; border-radius: 15px; font-size: 12px; display: inline-block; margin-bottom: 10px; }
        .filters { margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; }
        .filters select { padding: 8px; margin-right: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .no-image { width: 100px; height: 140px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #666; font-size: 12px; text-align: center; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Livraria Digital</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($ultimaCategoria)
            <div class="alert alert-success">
                Bem-vindo de volta! Última categoria visitada: <strong>{{ $ultimaCategoria }}</strong>
            </div>
        @endif

        <div class="filters">
            <form method="GET" style="display: inline;">
                <select name="categoria" onchange="this.form.submit()">
                    <option value="">Todas as categorias</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('livros.criar') }}" class="btn btn-success">📖 Adicionar Novo Livro</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Voltar ao Início</a>
        </div>

        @if($livros->count() > 0)
            @foreach($livros as $livro)
                <div class="livro-card">
                    <div>
                        @if($livro->imagem)
                            <img src="{{ asset('storage/uploads/' . $livro->imagem) }}" alt="{{ $livro->titulo }}" class="livro-imagem">
                        @else
                            <div class="no-image">Sem imagem</div>
                        @endif
                    </div>
                    <div class="livro-info">
                        <div class="livro-titulo">{{ $livro->titulo }}</div>
                        <div class="livro-autor">por {{ $livro->autor }}</div>
                        <div class="livro-categoria">{{ $livro->categoria }}</div>
                        @if($livro->isbn)
                            <div><strong>ISBN:</strong> {{ $livro->isbn }}</div>
                        @endif
                        <div><strong>Estoque:</strong> {{ $livro->estoque }} unidades</div>
                        @if($livro->descricao)
                            <div style="margin: 10px 0; color: #666;">{{ Str::limit($livro->descricao, 150) }}</div>
                        @endif
                        <div class="livro-preco">R$ {{ number_format($livro->preco, 2, ',', '.') }}</div>
                        <div>
                            <a href="{{ route('livros.mostrar', $livro->id) }}" class="btn btn-primary">👁️ Ver Detalhes</a>
                            <a href="{{ route('livros.editar', $livro->id) }}" class="btn btn-warning">✏️ Editar</a>
                            <form method="POST" action="{{ route('livros.excluir', $livro->id) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div style="text-align: center; padding: 50px; color: #666;">
                <h3>Nenhum livro encontrado</h3>
                <p>Comece adicionando o primeiro livro à sua livraria!</p>
                <a href="{{ route('livros.criar') }}" class="btn btn-success">📖 Adicionar Primeiro Livro</a>
            </div>
        @endif
    </div>
</body>
</html>