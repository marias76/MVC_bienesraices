<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)"
        value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellidos">Apellidos</label>
    <input type="text" id="apellidos" name="vendedor[apellidos]" placeholder="Apellidos Vendedor(a)"
        value="<?php echo s($vendedor->apellidos); ?>">
</fieldset>

<fieldset>
    <legend>Información Adicional</legend>
    <label for="telefono">Teléfono</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono"
        value="<?php echo s($vendedor->telefono); ?>">
</fieldset>

