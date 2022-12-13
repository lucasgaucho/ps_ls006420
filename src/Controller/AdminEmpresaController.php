<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Empresa;
use Petshop\View\Render;

class AdminEmpresaController
{
  public function listar()
  {
    //alimentando dados para a tabela de listagem
    $dadosListagem = [];
    $dadosListagem['objeto']  = new Empresa();
    $dadosListagem['imagens']  = true;
    $dadosListagem['colunas'] = [
      ['campo' => 'idempresa',  'class' => 'text-center'],
      ['campo' => 'nomefantasia',  'class' => 'text-center'],
      ['campo' => 'site',  'class' => 'text-center'],
      ['campo' => 'cidade',  'class' => 'text-center'],
      ['campo' => 'cnpj',  'class' => 'text-center'],
      ['campo' => 'razaosocial',  'class' => 'text-center'],
      ['campo' => 'telefone1'],
      ['campo' => 'created_at', 'class' => 'text-center'],
    ];
    $htmlTabela = Render::block('tabela-admin', $dadosListagem);

    $dados = [];
    $dados['titulo'] = 'Empresa - Listagem';
    $dados['usuario'] = $_SESSION['usuario'];
    $dados['tabela'] = $htmlTabela;

    Render::back('empresas', $dados);
  }

  public function form($valor)
  {
    //verificar se o parâmetro tem um número e, se for número, é um ID válido
    if (is_numeric($valor)) {
      $objeto = new Empresa();
      $resultado = $objeto->find(['idempresa=' => $valor]);
      if (empty($resultado)) {
        redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
      }
      $_POST = $resultado[0];
      $_POST['senha'] = '';
    }

    //cria e exibe o formulário
    $dados = [];
    $dados['titulo'] = 'Empresas - Manutenção';
    $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

    Render::back('empresas', $dados);
  }

  public function postForm($valor)
  {
    $objeto = new Empresa();

    //se $valor tem um número, carrega dados relativos a ele
    if (is_numeric($valor)) {
      if (!$objeto->loadById($valor)) {
        redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
      }
    }

    try {
      
      $campos = array_change_key_case($objeto->getFields());
      foreach($campos as $campo => $propriedades) {
        if(isset($_POST[$campo])) {
          $objeto->$campo = $_POST[$campo];
        }
      }

      $objeto->save();
      
    } catch(Exception $e) {
      $_SESSION['mensagem'] = [
        'tipo'=>'warning',
        'texto'=>$e->getMessage()
      ];

      $this->form($valor);
      exit;
    }
    redireciona('/admin/empresas', 'success', 'Alterações realizadas com SUCESSO');
  }

  public function renderizaFormulario($novo)
  {
    $dados = [
      'btn_class' => 'btn btn-warning px-5 mt-5',
      'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
      'fields' => [
        ['type' => 'readonly', 'name' => 'idempresa', 'class' => 'col-2', 'label' =>  'Id. Empresa'],
        ['type' => 'text', 'name' => 'nomefantasia', 'class' => 'col-5', 'label' => 'Nome', 'required'=>true],
        ['type' => 'text', 'name' => 'razaosocial', 'class' => 'col-2', 'label' => 'Razão Social', 'required'=>true],
        ['type' => 'text', 'name' => 'tipo', 'class' => 'col-3', 'label' => 'Tipo', 'required'=>true],
        ['type' => 'text', 'name' => 'cep', 'class' => 'col-4', 'label' => 'Cep', 'required'=>true],
        ['type' => 'text', 'name' => 'cidade', 'class' => 'col-6', 'label' => 'Cidade', 'required'=>true],
        ['type' => 'text', 'name' => 'estado', 'class' => 'col-5', 'label' => 'Estado', 'required'=>true],
        ['type' => 'text', 'name' => 'rua', 'class' => 'col-5', 'label' => 'Rua'],
        ['type' => 'text', 'name' => 'bairro', 'class' => 'col-4', 'label' => 'Bairro'],
        ['type' => 'text', 'name' => 'numero', 'class' => 'col-2', 'label' => 'Número'],
        ['type' => 'text', 'name' => 'telefone1', 'class' => 'col-4', 'label' => 'Telefone 01', 'required'=>true],
        ['type' => 'text', 'name' => 'telefone2', 'class' => 'col-3', 'label' => 'Telefone 02'],
        ['type' => 'text', 'name' => 'site', 'class' => 'col-3', 'label' => 'Site', 'required'=>true],
        ['type' => 'text', 'name' => 'email', 'class' => 'col-4', 'label' => 'Email', 'required'=>true],
        ['type' => 'text', 'name' => 'cnpj', 'class' => 'col-4', 'label' => 'CNPJ', 'required'=>true],
        ['type' => 'readonly', 'name' => 'created_at', 'class' => 'col-3', 'label' => 'Criado em:'],
        ['type' => 'readonly', 'name' => 'updated_at', 'class' => 'col-3', 'label' => 'Atualizado em:'],
      ]
    ];

    return Render::block('form', $dados);
  }
}