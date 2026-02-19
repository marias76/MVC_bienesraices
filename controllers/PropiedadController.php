<?php
namespace Controllers;
use MVC\router;
use Model\Propiedad;

class PropiedadController {
    public static function index(router $router) {
        $propiedades = Propiedad::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $_GET['resultado'] ?? null   
        ]);  
        
    }
    public static function crear() {
        echo "crear propiedad";
    }   

    public static function actualizar() {
        echo "actualizar propiedad";
    }   
}

?>