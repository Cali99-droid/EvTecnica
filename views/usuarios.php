<div class="contenedor   contenedor-xl">
    <div class="listado-usuarios">
        <p>Nombre</p>
        <p>Email </p>
        <p>Estado</p>
    </div>

    <?php

    foreach ($usuarios as $usuario) :
    ?>
        <div class="usuario">
            <p> <?php echo $usuario->nombre ?></p>
            <p> <?php echo $usuario->email ?></p>
            <p class="<?php echo $usuario->confirmado == 1 ?  'confirmado' :  'no-confirmado' ?>"> <?php echo $usuario->confirmado == 1 ?  'Activo' :  'No Activo' ?></p>

        </div>

    <?php endforeach; ?>
</div>