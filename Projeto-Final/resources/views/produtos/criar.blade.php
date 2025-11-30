<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo produto</title>
</head>
<body>

    <h1>Novo produto</h1>
    
    <form action="{{ route('produtos.salvar') }}" method="POST">
    @csrf

        <label for="">Nome:</label><br>
        <input type="text" name="nome"><br><br>
        <label for="">Preço:</label><br>
        <input type="number" name="preco"><br><br>
        <label for="">Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>

        <button type="submit">Criar</button>

    </form>

    <br>

    <a href="{{ route('produtos.index') }}">Voltar</a>

</body>
</html>