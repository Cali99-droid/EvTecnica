<form class="form-contact" method="POST">

    <h2>Registro Newsletter</h2>
    <?php include_once __DIR__ . "/templates/alertas.php" ?>
    <label for="nombre" class="contact-information">
        <span class="label">Nombre</span>
        <input class="input" type="text" id="nombre" name="nombre" placeholder="ej. Juan Manuel" value="<?php echo $usuario->nombre; ?>">
    </label>
    <label for="email" class="contact-information">
        <span class="label">Email</span>
        <input class="input" type="email" id="email" name="email" placeholder="ej. miemail@mail.com" value="<?php echo $usuario->email; ?>">
    </label>

    <div class="lista">
        <input class="submit" type="submit" value="enviar">
        <a class="submit" href="/usuarios">Ver emails registrados </a>
    </div>

</form>