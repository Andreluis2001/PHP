<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de produtos</title>
</head>
<body>
    <h1>Produtos cadastrados</h1>

    <a href="<?php echo e(route('produtos.criar')); ?>">Criar novo produto</a>

    <ul>
        <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <?php echo e($produto->nome); ?> - R$ <?php echo e($produto->preco); ?><br>
            <?php echo e($produto->descricao); ?>

        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

</body>
</html><?php /**PATH C:\Users\Paulo\Downloads\UnipamAulaApp\resources\views/produtos/index.blade.php ENDPATH**/ ?>