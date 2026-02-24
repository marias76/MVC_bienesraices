<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\DriverException;
class PropiedadController {
    public static function index(Router $router) {

        // trae todas las propiedades de la base de datos
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = null;

        // muestra los datos de las propiedades en la vista admin.php, 
        // que se encuentra en views/propiedades/admin.php
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $_GET['resultado'] ?? null   
        ]);  
        
    }
    public static function crear(Router $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $imagen = null;

        //arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['propiedad'] ?? [];
            $propiedad = new Propiedad($args);

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Procesar imagen si existe / subida de imágen 
            if (!empty($_FILES['propiedad']['tmp_name']['imagen'])) {
                try {
                    if (!extension_loaded('gd') || !function_exists('gd_info')) {
                        $errores[] = 'La extensión GD de PHP no está habilitada en este entorno.';
                    } else {
                        $manager = new Image(new Driver());
                        $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                        $propiedad->setImagen($nombreImagen);
                    }
                } catch (DriverException $e) {
                    $errores[] = 'No fue posible procesar la imagen: verifica la extensión GD de PHP.';
                }
            }

            // Validar imágen
            $errores = array_merge($errores, $propiedad->validar());

            // Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {

                //Subida de la imagen al servidor        
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }
                // Guardar la imagen en el servidor
                if ($imagen) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
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

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        if (!$propiedad instanceof Propiedad) {
            header('Location: /admin');
            exit;
        }
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        $imagen = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['propiedad'] ?? [];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();

            if (!empty($_FILES['propiedad']['tmp_name']['imagen'])) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                try {
                    if (!extension_loaded('gd') || !function_exists('gd_info')) {
                        $errores[] = 'La extensión GD de PHP no está habilitada en este entorno.';
                    } else {
                        $manager = new Image(new Driver());
                        $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                        $propiedad->setImagen($nombreImagen);
                    }
                } catch (DriverException $e) {
                    $errores[] = 'No fue posible procesar la imagen: verifica la extensión GD de PHP.';
                }

            }

            if (empty($errores)) {
                //Subida de la imagen al servidor        
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }
                // Guardar la imagen en el servidor
                if ($imagen) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                // Guardar en la base de datos
                $propiedad->creado = Propiedad::fechaActual();
                $resultado = $propiedad->guardar();
                if ($resultado) {
                    header('Location: /admin?resultado=2');
                    exit;
                }
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }   

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'] ?? '';
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    if ($propiedad instanceof Propiedad) {
                        $resultado = $propiedad->eliminar();
                        if ($resultado) {
                            header('Location: /admin?resultado=3');
                            exit;
                        }
                    }
                }
            }
        }
    }
}

?>