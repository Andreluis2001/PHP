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
    
    <body class="<?php echo e($tema); ?>">
        
    <!-- Session section -->
    <h2>Bem-vindo, <?php echo e($usuario); ?>!</h2>
    <p>Sua sessão está ativa.</p>

    <!-- Theme section -->
    <hr>

    <h3>Escolha o Tema (Cookie)</h3>
    <form action="<?php echo e(route('tema.salvar')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <select name="tema">
            <option value="claro" <?php echo e($tema == 'claro' ? 'selected' : ''); ?>>Claro</option>
            <option value="escuro" <?php echo e($tema == 'escuro' ? 'selected' : ''); ?>>Escuro</option>
        </select>
        <button type="submit">Salvar Tema</button>
    </form>

    <p>Tema atual (via cookie): <strong><?php echo e($tema); ?></strong></p>

    <!-- Upload section -->
    <hr>

    <h3>Upload de Arquivo</h3>

    <?php if(session('sucesso')): ?>
        <p style="color: green;"><?php echo e(session('sucesso')); ?></p>
    <?php endif; ?>

    <?php if(session('erro')): ?>
        <p style="color: red;"><?php echo e(session('erro')); ?></p>
    <?php endif; ?>

    <form action="<?php echo e(route('arquivo.upload')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="file" name="arquivo" required>
        <button type="submit">Enviar Arquivo</button>
    </form>

    <h4>Arquivos enviados:</h4>

    <?php if($arquivos->isEmpty()): ?>
        <p>Nenhum arquivo enviado ainda.</p>
    <?php else: ?>
        <ul>
            <?php $__currentLoopData = $arquivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arquivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <img src="<?php echo e($arquivo); ?>" alt="Imagem" width="120" style="border: 1px solid #999; margin: 5px;">
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <!-- AJAX Section -->
    <hr>

    <h3>Consulta AJAX</h3>

    <button id="btnAjax">Buscar usuário via AJAX</button>

    <p id="resultadoAjax" style="margin-top: 10px; font-weight:bold;"></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#btnAjax').click(function () {

            $.get("<?php echo e(route('ajax.usuario')); ?>", function(data) {
                $('#resultadoAjax').text("Usuário: " + data.nome + " | Mensagem: " + data.mensagem);
            });

        });
    </script>

    <hr>

    <!-- Logout Section (mata sessão) -->
    <a href="<?php echo e(route('logout')); ?>">Sair</a>

    </body>
</html>
<?php /**PATH C:\Users\Paulo\Downloads\UnipamAulaApp\resources\views/sessao/home.blade.php ENDPATH**/ ?>