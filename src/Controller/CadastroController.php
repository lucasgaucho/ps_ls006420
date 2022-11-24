<?php

namespace Petshop\Controller;

use Exception;
use Petshop\Core\FrontController;
use Petshop\Model\Cliente;
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

        public function postCadastro()
        {
            try {
            $cliente = new Cliente;
            $cliente->tipo      = $_POST['tipo'] ?? null;
            $cliente->cpfcnpj   = $_POST['cpfcnpj'] ?? null;
            $cliente->nome      = $_POST['nome'] ?? null;
            $cliente->email     = $_POST['email'] ?? null;
            $cliente->senha     = $_POST['senha'] ?? null;
            $cliente->save();
        }
        catch(Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo'  => 'warning',
                'texto' => $e->getMessage()
              ];
        
              $this->cadastro();
        }
    }

        public function FormCadastro()
        {
         $dados =[
            'btn-label'=>'Criar minha conta',
            'btn-class'=>'btn btn-sucess',
            'fields'=>[
                ['type'=>'radio-inline', 'class'=>'md-4', 'label'=>'Você é uma pessoa: ', 'name'=>'tipo', 'options'=>[
                    ['label'=>'Fisica', 'value'=>'F'],
                    ['label'=>'Juridica', 'value'=>'J']
                    ], 'required'=>true
                ],
                ['type'=>'text', 'class'=>'col-6', 'label'=>'Documento', 'name'=>'cpfcnpj', 'required'=>true],
                ['type'=>'text','label'=>'Seu nome completo', 'name'=>'nome', 'required'=>true],
                ['type'=>'email','label'=>'Seu melhor e-mail', 'name'=>'email', 'required'=>true],
                ['type'=>'password', 'class'=>'col-6', 'label'=>'Crie sua senha', 'name'=>'senha', 'required'=>true],
                ['type'=>'password', 'class'=>'col-6', 'label'=>'Confirme sua senha', 'name'=>'senha2', 'required'=>true]
            ]
         ];

         return Render::block('form', $dados);
        }

}