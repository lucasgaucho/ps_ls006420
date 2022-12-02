<?php

namespace Petshop\Controller;

use Petshop\Model\Cliente;
use Petshop\View\Render;

class AdminClienteController {
    public function listar()
    {
        $dadosListagem = [];
        $dadosListagem['objeto'] = new Cliente;
        $dadosListagem['colunas'] = [
            ['campo'=>'idcliente', 'class'=>'text-center'],
            ['campo'=>'tipo', 'class'=>'text-center'],
            ['campo'=>'nome'],
            ['campo'=>'email'],
            ['campo'=>'created_at', 'class'=>'text-center'],
        ];
        $htmlTabela = Render::block('tabela-admin', $dadosListagem);

        $dados = [];
        $dados['titulo'] = 'Clientes';
        $dados['tabela'] = $htmlTabela;

        Render::back('clientes', $dados);
    }
}