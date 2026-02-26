<!-- autenticación -->
<main class="contenedor seccion">
    <form method="post" class="formulario u-max-40" action="/login">
        <h1>Inciar Sesión</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <fieldset>
            <legend>Correo y Contraseña</legend>

            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" placeholder="Tú Correo" id="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tú Contraseña" id="password" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde u-center-block">

    </form>
</main>