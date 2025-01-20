<?php

define('C7E3L8K9E5', true);

// Carregar o Composer
require './vendor/autoload.php';

// Instaciar a classe ConfigController, responsável em tratar a URL
$url = new Core\ConfigController();

// Instanciar o método para carregar a página/controller
$url->loadPage();
