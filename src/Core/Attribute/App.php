<?php

namespace PetShop\Core;

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
        self::$router->get('/', 'PetShop\Controller\HomeController@index');
    }
    private static function RegistraRotasdoBackEnd()
    {
        
    }
}