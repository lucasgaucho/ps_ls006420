<?php
require_once __DIR__  . '/../vendor/autoload.php';

use Petshop\Core\DB;

$sql =  'INSERT INTO dicas (titulo, descricao) VALUES (?,?)';
$s = DB::query($sql, ['Dica 1', 'Descricao Dica 01']);
echo $s->rowCount();







/*
use Petshop\Core\DB;

$estados = DB::select('select * from estados where estado lie=ke = ?', [RS]
);

var_dump($estados);



echo date('d/m/Y H:i:s');
echo '<br>';
echo 'FRONTEND_TITLE';


$router = new \Bramus\Router\Router();

$router-> get('/', function() {
    echo 'Chegou na home page(via get)!';
});

$router-> get('/produtos', function() {
    echo 'Chegou na página de produtos (via get)!';
});

$router-> get('/produtos/{x}/{y}', function($codprod, $valor) {
    echo 'Chegou na página do produto ' . $codprod . '-' . $valor;
});

$router-> get('/filmes/214/ator/5', function($codprod, $valor) {
    echo "Página do filme{$filme}, sobre o ator {$ator}";
});

$router-> set404(function() {
    header('HTTP/1.1 404 NOT FOUND');
    echo 'Página não encontrada';
});

$router->run(); 
*/