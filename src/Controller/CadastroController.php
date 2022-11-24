<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;

class CadastroController extends FrontController {

        public function cadastro() {
            $dados = [];
            $dados['titulo'] = 'Faça seu Cadastro';
            $dados['topo'] = $this->carregaHtmlTopo();
            $dados['rodape'] = $this->carregaHtmlRodape();
            $dados['formCadastro'] = $this->formCadastro();

            Render::front('cadastro', $dados);
        }

        public function FormCadastro()
        {
            
        }

}