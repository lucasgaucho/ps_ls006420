<?php

namespace Petshop\Core;

use Bramus\Router\Router;

class App 
{
    private static $router;

    public static function start()
    {
        self::carregaSessao();

        self::$router = new Router;

        self::RegistraRotasdoBackEnd();
        self::RegistraRotasdoFrontEnd();
        self::Registra404Generico();
        
        self::$router->run();
    }   

    private static function RegistraRotasdoFrontEnd()
    {
        self::$router->get('/', '\Petshop\Controller\HomeController@index');
        self::$router->get('/login', '\Petshop\Controller\LoginController@login');
        self::$router->get('/cadastro', '\Petshop\Controller\CadastroController@cadastro');
        self::$router->post('/cadastro', '\Petshop\Controller\CadastroController@postcadastro');
    }
    private static function RegistraRotasdoBackEnd()
    {

    }

    public function registra404Generico()
    {
        self::$router->set404(function() {
            header('HTTP/1.1 404 Not found');
            $objErro = new ErrorController();
            $objErro->erro404;
        });
    }

    public function carregaSessao()
    {
        session_start();
    }
}