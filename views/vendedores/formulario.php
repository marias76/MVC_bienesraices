<!-- formulario para crear/actualizar vendedores -->

<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" value="<?php echo s($vendedor->nombre); ?>" placeholder="Nombre del vendedor">

    <label for="apellidos">Apellido:</label>
    <input type="text" id="apellidos" name="vendedor[apellidos]" value="<?php echo s($vendedor->apellidos); ?>" placeholder="Apellido del vendedor">

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" value="<?php echo s($vendedor->telefono); ?>" placeholder="Teléfono del vendedor">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="vendedor[descripcion]" placeholder="Descripción del vendedor"><?php echo s($vendedor->descripcion); ?></textarea>
</fieldset>