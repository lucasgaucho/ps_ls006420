<?php

namespace PetShop\View;

use Exception;

class Render {
    static public function front(string $pagina, array $dados) 
    {
        $pathPagina = TFRONTEND . 'pages/' . $pagina . 'php';

        if(!file_exists($pathPagina)) {
            error_log('Página template não localizada em: ' .'$pathPagina');
            throw new Exception('A pagina solicitada não foi localizada');
        }

        if( empty($dados['titulo'])) {
            $dados['titulo'] = FRONTEND_TITLE
        } 
        else {
            $dados['titulo'] = $dados['titulo'] . ' - ' . FRONTEND_TITLE
        }

        extract($dados);
    
        require_once TPFRONTEND . 'common/top.php';
        require_once $pathPagina;
        require_once TPFRONTEND . 'common/bottom.php';
    }

}