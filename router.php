<?php
namespace MVC;
class Router{
    public $rutasGET = []; 
    public $rutasPOST = []; 
    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
    
        //arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
        $urlActual = rtrim($urlActual, '/');
        if ($urlActual === '') {
            $urlActual = '/';
        }

        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($metodo === 'GET') {
            $rutas = $this->rutasGET;
        } else {
            $rutas = $this->rutasPOST;
        }

        // Verificar si la ruta actual está protegida
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
            return;
        }

        foreach ($rutas as $ruta => $funcion) {
            if ($ruta === $urlActual) {
                call_user_func($funcion, $this);
                return;
            }
        }
        http_response_code(404);
        echo "Página no encontrada";
    }
    public function get($ruta, $funcion)
    {
        $this->rutasGET[$ruta] = $funcion;
    }
    public function post($ruta, $funcion)
    {
        $this->rutasPOST[$ruta] = $funcion;
    }

    //muestra una Vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }   

        ob_start();// Inicia el almacenamiento en búfer de salida
        $rutaVista = __DIR__ . "/views/" . $view . ".php";
        include $rutaVista;

        $contenido = ob_get_clean();    // Obtiene el contenido del búfer y lo limpia
        include __DIR__ . "/views/layout.php";

        return $contenido;
        
    }
}