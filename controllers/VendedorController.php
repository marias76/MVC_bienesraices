<?php
namespace Controllers;
use Model\Vendedor;

class VendedorController {
    public static function crear(\MVC\router $router) {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['vendedor'] ?? [];
            $vendedor = new Vendedor($args);
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $resultado = $vendedor->guardar();
                if ($resultado) {
                    header('Location: /admin?resultado=1');
                    exit;
                }
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]); 
    }

    public static function actualizar(\MVC\router $router) {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);

        if (!$vendedor) {
            header('Location: /admin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['vendedor'] ?? [];
            $vendedor = new Vendedor($args);
            $vendedor->id = $id;
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $resultado = $vendedor->guardar();
                if ($resultado) {
                    header('Location: /admin?resultado=2');
                    exit;
                }
            }
        }
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]); 
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $vendedor = Vendedor::find($id);
                if ($vendedor) {
                    $resultado = $vendedor->eliminar();
                    if ($resultado) {
                        header('Location: /admin?resultado=3');
                        exit;
                    } else {
                        header('Location: /admin?resultado=4');
                        exit;
                    }
                }
            }
        }
        header('Location: /admin?resultado=4');
        exit;
    }

}