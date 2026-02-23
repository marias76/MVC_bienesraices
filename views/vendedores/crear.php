<h1>Crear Vendedores</h1>

<main class="contenedor seccion">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" enctype="multipart/form-data" action="/vendedores/crear">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>

</main>
