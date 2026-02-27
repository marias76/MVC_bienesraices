<!-- Página principal del layout, se muestra en todas las vistas, 
 el contenido de cada vista se inyecta en la variable $contenido, 
 que se muestra en el layout.php -->

<?php
// Determinar si es la página de inicio
if (session_status() === PHP_SESSION_NONE) {
     session_start();    
}

$auth = $_SESSION['login'] ?? false;
 if(!isset($inicio)){
     $inicio = false;   

 }
?>  

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>MVC Bienes Raíces</title>
</head>

<body>
    <!-- header -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-principal" src="/build/img/logo.svg" alt="logotipo de bienes raíces">
                </a>
           <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="icono dark mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div><!-- .barra -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ""; ?>  
        </div>
    </header>

    <!-- muestra el contenido de cada vista, que se inyecta en el layout.php a través 
     del método render del router.php -->
    <?php echo $contenido; ?>
    <!-- footer -->
    <footer class="footer seccion">
    <div class="contenedor contenedor-footer">
        <nav class="navegacion">
            <a href="/nosotros">Nosotros</a>
            <a href="/anuncios">Anuncios</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contacto</a>
        </nav>
    </div>

    <p class="copyright">Todos los derechos reservados, <?php echo date('Y'); ?> &copy;</p>
</footer>

<script src="/build/js/bundle.min.js"></script>
</body>

</html>