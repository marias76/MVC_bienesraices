<!-- main -->
<main class="contenedor seccion">
    <h1>Contacto</h1>
    
    <?php if(isset($mensaje)) { ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>

    <picture>
        <source srcset="./build/img/destacada3.webp" type="image/webp">
        <source srcset="./build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="./build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2>Llene el Formulario de Contacto</h2>

    <form action="/contacto" class="formulario" method="post">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="contacto[nombre]" placeholder="Tu Nombre" required>            
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" cols="30" rows="10" placeholder="Escribe tu mensaje"
                required></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Sobre Propiedad</legend>
            <label for="tipo">Vende o Compra</label>
            <select name="contacto[tipo]" id="tipo" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto:</label>
            <input type="number" id="presupuesto" name="contacto[presupuesto]" placeholder="Tu Precio o Presupuesto"
                required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p><span>¿Cómo desea ser contactado?</span></p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" name="contacto[contacto]" value="telefono" id="contactar-telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" name="contacto[contacto]" value="email" id="contactar-email" required>
            </div>

            <div id="contacto"></div>

        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>