<?php
namespace Petshop\View;

use Petshop\Core\Exception;

class Render
{
  static public function front(string $pagina, array $dados=[]) 
  {
    $pathPagina = TFRONTEND . 'pages/' . $pagina . '.php';

    if (!file_exists($pathPagina)) {
      error_log('Página template não localizada em: ' . $pathPagina);
      throw new Exception("A página solicitada ''{$pagina} não foi localizada");
    }

    if (empty($dados['titulo'])) {
      $dados['titulo'] = FRONTEND_TITLE;
    } else {
      $dados['titulo'] = $dados['titulo'] . ' - ' . FRONTEND_TITLE;
    }

    extract($dados);

    require_once TFRONTEND . 'common/top.php';
    require_once $pathPagina;
    require_once TFRONTEND . 'common/bottom.php'; 
  }
}