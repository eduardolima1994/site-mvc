<?php

namespace Sts\Controllers;

if(!defined('C7E3L8K9E5')){
    //header('Location: /');
    die("Erro: Página não encontrada!");
  }

class Erro
{
    private array $data;

    public function index()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView("sts/Views/erro/erro", $this->data);
        $loadView->loadView();
    }
}