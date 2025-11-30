<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Teste</title>
</head>
<body>
    @if (request()->is('testeData'))
        <h1>{{ $info }}</h1>
    @elseif (request()->is('teste'))
        <h2>Teste de View</h2>
    @endif
</body>
</html>