<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de produtos</title>
</head>
<body>
    <h1>Produtos cadastrados</h1>

    <a href="{{ route('produtos.criar') }}">Criar novo produto</a>

    <ul>
        @foreach($produtos as $produto)
        <li>
            {{$produto->nome}} - R$ {{ $produto->preco }}<br>
            {{ $produto->descricao }}
        </li>
        @endforeach
    </ul>

</body>
</html>