<main class="contenedor seccion">
    <h1>Crear</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    
    <form class="formulario" method="post" action="" enctype="multipart/form-data">
        <?php
          include __DIR__ . '/formulario.php';  
        ?>
        <a href="/propiedades/crear" class="boton-verde">🧹 Limpiar</a>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>


</main>