<?php

namespace Petshop\Controller;

use Petshop\View\Render;

class AdminDashboardController {
    public function index()
    {
        $dados = [];
        $dados['titulo'] = 'Inicio';

        Render::back('dashboard', $dados);
    }
}