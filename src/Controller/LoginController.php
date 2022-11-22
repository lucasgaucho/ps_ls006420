<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;

class LoginController extends FrontController {

        public function login() {
            $dados = [];
            $dados['titulo'] = 'Pagina de Login / Cadastro';
            $dados['topo'] = $this->carregaHtmlTopo();
            $dados['rodape'] = $this->carregaHtmlRodape();
            $dados['formLogin'] = $this->formLogin();

                Render::front('login', $dados);
        }

        public function FormLogin()
        {
            $dados = [
                'btn_label'=>'Entrar',
                'btn_class'=>'btn btn-warning',
                'fields'=>[
                    ['type'=>'email', 'name'=>'email', 'label'=>'Usuário','placeholder'=>'Seu e-mail cadastrado', 'required'=>true],
                    ['type'=>'password', 'name'=>'senha', 'required'=>true],
                ]
            ];
            return Render::block('form', $dados);
        }

}