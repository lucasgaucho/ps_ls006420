<?php

namespace Petshop\Core;

use Petshop\View\Render;
use Petshop\Model\Empresa;

abstract class FrontController {
    public function carregaHtmlTopo()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);

        if (!empty($_SESSION['cliente'])) {
            $dados[0]['cliente'] = $_SESSION['cliente'];
          }
      
          return Render::block('topo', $dados[0]);
        }
    

    public function carregaHtmlRodape()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);
        return Render::block('rodape', $dados[0]);
    }
}

