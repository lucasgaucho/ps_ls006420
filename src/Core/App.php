<?php

namespace Petshop\Core;

use Bramus\Router\Router;

class App 
{
    private static $router;

    public static function start()
    {
        self::$router = new Router;

        self::RegistraRotasdoBackEnd();
        self::RegistraRotasdoFrontEnd();
        
        self::$router->run();
    }   

    private static function RegistraRotasdoFrontEnd()
    {
        self::$router->get('/', '\Petshop\Controller\HomeController@index');
        self::$router->get('/login', '\Petshop\Controller\LoginController@index');
    }
    private static function RegistraRotasdoBackEnd()
    {
        
    }
}