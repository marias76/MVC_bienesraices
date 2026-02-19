<?php

define('TEMPLATES_URL', __DIR__. '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/' );

//require 'app.php';
function incluirTemplates( string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

function estadoAutenticado() {
    session_start();

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: /");
        exit;
    }
    // No redirigir aquí si ya estás en /admin/index.php
}
function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//escapa / sanitizar el HTML
function s($html): string {
    $s = htmlspecialchars($html);
    return $s;
}

// muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
