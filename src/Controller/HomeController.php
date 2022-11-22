<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Core\Model\Estado;
use Petshop\View\Render;

class HomeController extends FrontController {
    
    public function index()
    {

        $dados = [];
        $dados['titulo'] = 'Página Inicial';
        $dados['topo'] = $this->carregaHtmlTopo();
        $dados['rodape'] = $this->carregaHtmlRodape();

        Render::front('home', $dados);
    }
}