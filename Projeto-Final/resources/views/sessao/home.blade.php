<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Área Logada</title>

        <style>
            body.claro {
                background: #ffffff;
                color: #000000;
            }
            body.escuro {
                background: #111111;
                color: #ffffff;
            }
        </style>
    </head>
    
    <body class="{{ $tema }}">
        
    <!-- Session section -->
    <h2>Bem-vindo, {{ $usuario }}!</h2>
    <p>Sua sessão está ativa.</p>

    @if($ultimaCategoria)
        <p style="background-color: #e7f3ff; padding: 10px; border-radius: 5px;">
            📚 Última categoria visitada na livraria: <strong>{{ $ultimaCategoria }}</strong>
        </p>
    @endif

    <!-- Navigation section -->
    <hr>
    <h3>📚 Livraria Digital</h3>
    <p>
        <a href="{{ route('livros.index') }}" style="padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Ver Todos os Livros</a>
        <a href="{{ route('livros.criar') }}" style="padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">Adicionar Novo Livro</a>
    </p>

    <!-- Theme section -->
    <hr>

    <h3>Escolha o Tema (Cookie)</h3>
    <form action="{{ route('tema.salvar') }}" method="POST">
        @csrf
        <select name="tema">
            <option value="claro" {{ $tema == 'claro' ? 'selected' : '' }}>Claro</option>
            <option value="escuro" {{ $tema == 'escuro' ? 'selected' : '' }}>Escuro</option>
        </select>
        <button type="submit">Salvar Tema</button>
    </form>

    <p>Tema atual (via cookie): <strong>{{ $tema }}</strong></p>

    <!-- Upload section -->
    <hr>

    <h3>Upload de Arquivo</h3>

    @if(session('sucesso'))
        <p style="color: green;">{{ session('sucesso') }}</p>
    @endif

    @if(session('erro'))
        <p style="color: red;">{{ session('erro') }}</p>
    @endif

    <form action="{{ route('arquivo.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="arquivo" required>
        <button type="submit">Enviar Arquivo</button>
    </form>

    <h4>Arquivos enviados:</h4>

    @if($arquivos->isEmpty())
        <p>Nenhum arquivo enviado ainda.</p>
    @else
        <ul>
            @foreach($arquivos as $arquivo)
                <li>
                    <img src="{{ $arquivo }}" alt="Imagem" width="120" style="border: 1px solid #999; margin: 5px;">
                </li>
            @endforeach
        </ul>
    @endif

    <!-- AJAX Section -->
    <hr>

    <h3>Consulta AJAX</h3>

    <button id="btnAjax">Buscar usuário via AJAX</button>

    <p id="resultadoAjax" style="margin-top: 10px; font-weight:bold;"></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#btnAjax').click(function () {

            $.get("{{ route('ajax.usuario') }}", function(data) {
                $('#resultadoAjax').text("Usuário: " + data.nome + " | Mensagem: " + data.mensagem);
            });

        });
    </script>

    <hr>

    <!-- Logout Section (mata sessão) -->
    <a href="{{ route('logout') }}">Sair</a>

    </body>
</html>
