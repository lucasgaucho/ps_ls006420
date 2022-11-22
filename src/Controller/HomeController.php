<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Core\Model\Estado;
use Petshop\View\Render;

class HomeController extends FrontController {
    
    public function index()
    {
        //$estados = (new Estado())->find();

        $dados = [];
        $dados['titulo'] = 'Página Inicial';
        //$dados['estados'] = $estados;
        $dados['topo'] = $this->carregaHtmlTopo();
        $dados['rodape'] = $this->carregaHtmlRodape();

        Render::front('home', $dados);
    }
}