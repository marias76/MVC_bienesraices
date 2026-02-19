<?php
namespace MVC;
class router{
    public $rutasGET = []; 
    public $rutasPOST = []; 
    public function comprobarRutas()
    {
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $rutas = $this->rutasGET;
        } else {
            $rutas = $this->rutasPOST;
        }

        foreach ($rutas as $ruta => $funcion) {
            if ($ruta === $urlActual) {
                call_user_func($funcion, $this);
                return;
            }
        }
        // Si no se encuentra la ruta, puedes mostrar una página de error o redirigir a una página predeterminada
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