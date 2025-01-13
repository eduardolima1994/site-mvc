<?php

namespace Core;

class ConfigController
{
    private string $url;

    public function __construct()
    {
        echo "Carregar a página<br>";
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            var_dump($this->url);

            //$situacao = filter_input(INPUT_GET, 'situacao', FILTER_DEFAULT);
            //var_dump($situacao);
            //$origem = filter_input(INPUT_GET, 'origem', FILTER_DEFAULT);
            //var_dump($origem);
        }else{
            echo "Acessar a página inicial<br>";
        }

    }
}