<?php
require_once __DIR__ . '/../includes/app.php';
use MVC\router;
use Controllers\PropiedadController;

$router = new router(); 

$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->comprobarRutas();
