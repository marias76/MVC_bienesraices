<div class="contenedor-anuncios">
    <!--anuncio-->
    <?php foreach($propiedades as $propiedad) {?>
    <?php /** @var \Model\Propiedad $propiedad */ ?>
    <div class="anuncio">
        <!-- contenido anuncio 1-->

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio 1">

        <div class="contenido-anuncio">
            <h3><?php echo s($propiedad->titulo); ?></h3>
            <p><?php echo s($propiedad->descripcion); ?></p>
            <p class="precio">$<?php echo number_format($propiedad->precio, 2); ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_wc.svg" alt="Icono WC">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_estacionamiento.svg"
                        alt="Icono Estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="Icono Dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
        </div>
    </div><!-- contenido anuncio 1-->
    <?php } ?>
</div><!-- anuncio -->