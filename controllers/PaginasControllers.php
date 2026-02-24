<?php

namespace Controllers;  
class PaginasControllers {
    public static function index($router) {
        $router->render('paginas/index');                                          
    }
    public static function nosotros($router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades($router) {
        $router->render('paginas/propiedades');
    }
    public static function propiedad($router) {
        $router->render('paginas/propiedad');
    }
    public static function blog($router) {
        $router->render('paginas/blog');
    }
    public static function entrada($router) {
        $router->render('paginas/entrada');
    }   
    public static function contacto($router) {
        $router->render('paginas/contacto');
    }   
}











