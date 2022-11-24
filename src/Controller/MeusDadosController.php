<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;

class MeusDadosController extends FrontController {

    public function meuCadastro() {
        $dados = [];
        $dados['topo'] = $this->carregaHtmlTopo();
        $dados['rodape'] = $this->carregaHtmlRodape();

            Render::front('meus-dados', $dados);
    }
}