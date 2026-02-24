
<!-- main -->
<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="/build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac
                consectetur ac, vestibulum at eros.</p>
        </div>
        <div class="icono">
            <img src="/build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac
                consectetur ac, vestibulum at eros.</p>
        </div>
        <div class="icono">
            <img src="/build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac
                consectetur ac, vestibulum at eros.</p>
        </div>

    </div>
</main><!-- main -->

<!-- contenedor-anuncios -->
<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>

    <?php
    $limite = 3;
    include 'includes/templates/anuncios.php';
    ?>

    <div class="alinear-derecha"><!-- boton ver todas -->
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>
</section><!-- contenedor-anuncios -->

<!-- seccion contacto -->
<section class="imagen-contacto"><!-- seccion contacto -->
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
</section><!-- seccion contacto -->

<!--blog y Testimoniales-->
<div class="contenedor seccion seccion-inferior">
    <section class="blog"><!--blog-->
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="/build/img/blog1.webp" type="image/webp">
                    <source srcset="/build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="/build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el Techo de Tú Casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por: <span>Admin</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                        ahorrando dinero</p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="/build/img/blog2.webp" type="image/webp">
                    <source srcset="/build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="/build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la Decoración de Tú Hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por: <span>Admin</span></p>
                    <p>Maximizar el espacio en tú hogar con esta guía, aprende a combinar muebles y colores para
                        darle vida a tú espacio</p>
                </a>
            </div>
        </article>
    </section><!--blog-->

    <section class="testimoniales"><!--Testimoniales-->
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron
                cumple con todas mis expectativas.
            </blockquote>
            <p>- Marco Antonio</p>
        </div>
    </section><!--Testimoniales-->

</div><!--blog y Testimoniales-->
