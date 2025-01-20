<?php

namespace Core;

if(!defined('C7E3L8K9E5')){
  header('Location: /');
  die("Erro: Página não encontrada!");
}

class ConfigView
{
    public function __construct(private string $nameView, private array|string|null $data)
    {
    }

    public function loadView(): void
    {
        if(file_exists('app/' . $this->nameView . '.php')){
            include './app/sts/Views/include/header.php';
            include 'app/' . $this->nameView . '.php';
            include './app/sts/Views/include/footer.php';
        }else{
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
        }
    }
}