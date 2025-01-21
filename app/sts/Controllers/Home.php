<?php

namespace Sts\Controllers;

if(!defined('C7E3L8K9E5')){
    header('Location: /');
    die("Erro: Página não encontrada!");
}

class Home
{
    private array $data;

    public function index()
    {
        $home = new \Sts\Models\StsHome();
        $this->data = $home->index();

        $loadView = new \Core\ConfigView("sts/Views/home/home", $this->data);
        $loadView->loadView();
    }
}