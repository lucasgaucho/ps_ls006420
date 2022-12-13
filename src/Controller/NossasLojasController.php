<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;
use Petshop\Model\Empresa;

class NossasLojasController extends FrontController {

    public function listar() {

        $dados = [];
        $dados['topo'] = $this->carregaHtmlTopo();
        $dados['rodape'] = $this->carregaHtmlRodape();
        $dados['empresa'] = $_SESSION['empresa'];

            Render::front('nossas-lojas', $dados);
    }
}

die("Não consegui fazer funcionar essa parte professor..");

/*
$dadosListagem = [];
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
*/
?>
<!DOCTYPE html> 
  <html> 
    <head> 
      <meta charset="UTF-8"> 
      <title>Tutorial</title> 
    </head> 
    <body> 
      <table border="1"> 
        <tr> 
          <td>Id</td> 
          <td>Nome</td>
        </tr> 
        <?php while($dados = $con->fetch_array()) { ?> 
        <tr> 
          <td><?php echo $dados['idempresa']; ?></td>
          <td><?php echo $dados['nomefantasia']; ?></td> 
          <td><?php //echo $dado['usu_email']; ?></td> 
          <td><?php //echo date('d/m/Y', strtotime($dado['usu_datadecadastro'])); ?></td> 
          <td> 
          </td> 
        </tr> 
        <?php }
       
        ?> 
      </table> 
    </body> 
</html>