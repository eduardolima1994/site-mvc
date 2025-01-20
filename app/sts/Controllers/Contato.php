<?php

namespace Sts\Controllers;

if(!defined('C7E3L8K9E5')){
    //header('Location: /');
    die("Erro: Página não encontrada!");
  }
  

class Contato
{
    private array|string|null $data;

    public function index()
    {
        $this->data = "Mensagem enviada com sucesso!<br>";
        $loadView = new \Core\ConfigView("sts/Views/contato/contato", $this->data);
        $loadView->loadView();
    }
}