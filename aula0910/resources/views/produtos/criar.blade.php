<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
</head>
<body>
    <h1>Novo Produto</h1>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($erros->all() as $erro)
                <li>{{$erro}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('produtos.salvar')}}" method="POST">
    @csrf
        <label for="">Nome:</label>
        <input type="text" name="nome" value="{{old('nome')}}"><br><br>

        <label for="">Preço:</label>
        <input type="text" name="preco" value="{{old('preco')}}"><br><br>

        <label for="">Descrição:</label>
        <textarea name="decricao">{{old('descricao')}}</textarea>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="{{route('produtos.index')}}">Voltar</a>
</body>
</html>