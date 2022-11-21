<?php

namespace Petshop\Core;
use Petshop\View\Render;
use Petshop\Model\Empresa;

abstract class FrontController {
    public function carregaTopo()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);
        return Render::block('topo', $dados[0]);
    }

    public function carregaHtmlRodape()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);
        return Render::block('topo', $dados[0]);
    }
}