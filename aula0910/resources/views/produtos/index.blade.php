<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Produtos</title>
</head>
<body>
    <h1>Produtos Cadastrados</h1>
    <a href="{{route('produtos.criar')}}">Novo Produto</a>

    <ul>
        @foreach($produtos as $item)
        <li>
            <strong>{{$item->nome}}</strong> | R$ {{number_format($item->preco, 2, '.', ',')}}
            {{item->descricao}}
        </li>
        @endforeach
    </ul>
</body>
</html>
