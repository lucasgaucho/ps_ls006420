<?php

namespace Petshop\Core;

use Bramus\Router\Router;
use Petshop\Controller\ErrorController;

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
        self::$router->get('/logout', '\Petshop\Controller\LoginController@logout');
        self::$router->post('/login', '\Petshop\Controller\LoginController@postLogin');
        self::$router->get('/cadastro', '\Petshop\Controller\CadastroController@cadastro');
        self::$router->post('/cadastro', '\Petshop\Controller\CadastroController@postcadastro');
        self::$router->get('/meus-dados', '\Petshop\Controller\MeusDadosController@meusDados');
        self::$router->get('/fale-conosco', '\Petshop\Controller\FaleConoscoController@faleConosco');
        self::$router->post('/fale-conosco',    '\Petshop\Controller\FaleConoscoController@postFaleConosco');
    }

    private static function RegistraRotasdoBackEnd()
    {
        self::$router->mount('/admin', function () {
            self::$router->get('/', '\Petshop\Controller\AdminDashboardController@index');
            self::$router->get('/clientes/{valor}', '\Petshop\Controller\AdminClienteController@form');
            self::$router->post('/clientes/{valor}', '\Petshop\Controller\AdminClienteController@postForm');
            self::$router->get('/clientes',  '\Petshop\Controller\AdminClienteController@listar');
        });
    }

    public static function registra404Generico()
    {
        self::$router->set404(function () {
            header('HTTP/1.1 404 Not found');
            $objErro = new ErrorController();
            $objErro->error404;
        });
    }

    public static function carregaSessao()
    {
        session_start();
    }
}
