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
    public static function crear(router $router) {
        // echo "crear propiedad";
            $router->render('propiedades/crear', [
                'propiedad' => new Propiedad()

            ]);
    }   

    public static function actualizar() {
        echo "actualizar propiedad";
    }   
}

?>