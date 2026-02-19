<?php
/**
 * formulario_propiedades.php
 * Formulario para crear/actualizar propiedades
 *
 * @var \Model\Propiedad   $propiedad   Instancia de Propiedad que se está creando o editando
 * @var \Model\Vendedor[]  $vendedores  Array de objetos Vendedor disponibles para asignar
 */
?>

<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad"
        value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad"
        value="<?php echo s($propiedad->precio); ?>">
    
    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
    <?php if ($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo s($propiedad->imagen); ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>
    <label for="habitaciones">Habitaciones</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9"
        value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">
    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9"
        value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <select name="propiedad[vendedor_id]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach ($vendedores as $vendedor): ?>
            <option 
                value="<?php echo s($vendedor->id); ?>"
                <?php echo ((int)$propiedad->vendedor_id === (int)$vendedor->id) ? 'selected' : ''; ?>>
                <?php echo s($vendedor->nombre . " " . $vendedor->apellidos); ?>
            </option>
        <?php endforeach; ?>
    </select>
</fieldset>