<?php

namespace PetShop\Controller;

use Petshop\View\Render;
use Petshop\Model\Estado;

class HomeController {
    public function index()
    {
        $estados = (new Estado())->find();

        $dados = [];
        $dados['titulo'] = 'Lista de Estados';
        $dados['estados'] = $estados;
        Render::front('home', $dados);
    }
}