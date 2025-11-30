<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $livro->titulo }} - Detalhes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .livro-header { display: flex; gap: 30px; margin-bottom: 30px; }
        .livro-imagem { width: 200px; height: 280px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .no-image { width: 200px; height: 280px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #666; border-radius: 8px; text-align: center; }
        .livro-info { flex: 1; }
        .livro-titulo { font-size: 28px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .livro-autor { font-size: 18px; color: #666; margin-bottom: 15px; }
        .livro-preco { font-size: 24px; font-weight: bold; color: #28a745; margin-bottom: 15px; }
        .livro-categoria { background-color: #007bff; color: white; padding: 8px 15px; border-radius: 20px; font-size: 14px; display: inline-block; margin-bottom: 15px; }
        .info-item { margin-bottom: 10px; }
        .info-label { font-weight: bold; color: #333; }
        .info-value { color: #666; }
        .descricao { background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .descricao h3 { margin-top: 0; color: #333; }
        .btn { display: inline-block; padding: 12px 20px; margin: 10px 10px 0 0; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn:hover { opacity: 0.8; }
        .estoque { padding: 10px 15px; border-radius: 8px; margin: 10px 0; }
        .estoque.disponivel { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .estoque.baixo { background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
        .estoque.indisponivel { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="livro-header">
            <div>
                @if($livro->imagem)
                    <img src="{{ asset('storage/uploads/' . $livro->imagem) }}" alt="{{ $livro->titulo }}" class="livro-imagem">
                @else
                    <div class="no-image">
                        <div>
                            📚<br>
                            Sem imagem<br>
                            disponível
                        </div>
                    </div>
                @endif
            </div>
            <div class="livro-info">
                <h1 class="livro-titulo">{{ $livro->titulo }}</h1>
                <div class="livro-autor">por {{ $livro->autor }}</div>
                <div class="livro-categoria">{{ $livro->categoria }}</div>
                <div class="livro-preco">R$ {{ number_format($livro->preco, 2, ',', '.') }}</div>
                
                @if($livro->isbn)
                    <div class="info-item">
                        <span class="info-label">ISBN:</span>
                        <span class="info-value">{{ $livro->isbn }}</span>
                    </div>
                @endif

                <div class="info-item">
                    <span class="info-label">Adicionado em:</span>
                    <span class="info-value">{{ $livro->created_at->format('d/m/Y H:i') }}</span>
                </div>

                @if($livro->updated_at != $livro->created_at)
                    <div class="info-item">
                        <span class="info-label">Última atualização:</span>
                        <span class="info-value">{{ $livro->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif

                <div class="estoque {{ $livro->estoque > 10 ? 'disponivel' : ($livro->estoque > 0 ? 'baixo' : 'indisponivel') }}">
                    <strong>Estoque:</strong> 
                    @if($livro->estoque > 10)
                        {{ $livro->estoque }} unidades (Disponível)
                    @elseif($livro->estoque > 0)
                        {{ $livro->estoque }} unidades (Estoque baixo)
                    @else
                        Indisponível
                    @endif
                </div>
            </div>
        </div>

        @if($livro->descricao)
            <div class="descricao">
                <h3>📋 Descrição</h3>
                <p>{{ $livro->descricao }}</p>
            </div>
        @endif

        <div>
            <a href="{{ route('livros.editar', $livro->id) }}" class="btn btn-warning">✏️ Editar</a>
            <form method="POST" action="{{ route('livros.excluir', $livro->id) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Excluir</button>
            </form>
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">⬅️ Voltar à Lista</a>
        </div>
    </div>
</body>
</html>