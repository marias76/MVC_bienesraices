<?php
namespace Controllers;
use MVC\router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
class PropiedadController {
    public static function index(router $router) {
        $propiedades = Propiedad::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $_GET['resultado'] ?? null   
        ]);  
        
    }
    public static function crear(router $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        //arreglo con mensajes de errores
        $errores = propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Procesar imagen si existe / subida de imágen 
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(new Driver());
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar imágen
            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {

                //Subida de la imagen al servidor        
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }
                // Guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                // Guardar en la base de datos
                // $ejecutado = $propiedad->crear();
                $propiedad->crear();
            }
    }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }   

    public static function actualizar(router $router) {
        echo "actualizar propiedad";
    }   
}

?>