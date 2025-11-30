<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Simples</title>
</head>
<body>

<h2>Login</h2>

<form action="{{ route('login') }}" method="POST">
    @csrf
    <label>Digite seu nome:</label><br>
    <input type="text" name="nome"><br><br>
    <button type="submit">Entrar</button>
</form>

</body>
</html>
