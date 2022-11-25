<?php

namespace Petshop\Controller;

use  Petshop\Core\FrontController;
use Petshop\View\Render;


class FaleConoscoController extends FrontController 
{
    public function faleConosco()
    {
       $dados = [];
        $dados['topo'] = $this->carregaHtmlTopo();
        $dados['rodape'] = $this->carregaHtmlRodape();
        $dados['formulario'] = $this->faleConosco();

        Render::front('meus-dados', $dados);
    }
       
    private function formFaleConosco() {

        }
    
    
}