<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginControllers {
    public static function login(Router $router) {
        $errores = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo 'autenticando...';
    }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
        
    }

    public static function logout() {
        echo 'Logout';
    }
}
