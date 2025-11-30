<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Simples</title>
</head>
<body>

<h2>Login</h2>

<form action="<?php echo e(route('login')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label>Digite seu nome:</label><br>
    <input type="text" name="nome"><br><br>
    <button type="submit">Entrar</button>
</form>

</body>
</html>
<?php /**PATH C:\Users\Paulo\Downloads\UnipamAulaApp\resources\views/sessao/login.blade.php ENDPATH**/ ?>