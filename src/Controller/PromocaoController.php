<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;
use Petshop\Model\Promocao;

class PromocaoController extends FrontController
{
  public function listapromocao()
  {
    $dados = [];
    $dados['topo'] = $this->carregaHTMLTopo();
    $dados['rodape'] = $this->carregaHTMLRodape();

    $promocao = new Promocao();
    $rowsPromocao = $promocao->find();

    foreach ($rowsPromocao as &$e) {
      $promocao = new Promocao();
      $promocao->loadById($e['idpromocao']);
      $e['imagens'] = $promocao->getFiles();
    }
    $dados['promocao'] = $rowsPromocao;

    Render::front('promocao', $dados);
  }
}