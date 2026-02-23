<!-- formulario actualizar propiedad -->
 
<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    
    <!-- revisa si hay errores en el formulario, si los hay los muestra en la vista actualizar.php -->
    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    
    <a href="/admin" class="boton-verde">🏠 Volver al Inicio</a>
    
    <form class="formulario" method="post" action="" enctype="multipart/form-data">
        <?php
          include __DIR__ . '/formulario.php';  
        ?>
        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-verde">🧹 Limpiar</a>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>