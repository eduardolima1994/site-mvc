<?php

namespace Core;

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    // private string $urlParameter;
    private string $urlSlugController;
    private array $format;

    

    public function __construct()
    {
        $this->config();
        //echo "Carregar a página<br>";
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            //var_dump($this->url);

            $this->clearUrl();

            $this->urlArray = explode("/", $this->url);
            var_dump($this->urlArray);

            if(isset($this->urlArray[0])){
                //var_dump($this->urlArray[0]);    
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else{
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }
        }else{
            $this->urlController = $this->slugController(CONTROLLER);
        }

        echo "Controller: {$this->urlController}<br>";

    }

    private function clearUrl()
    {
        // Eliminar as tags
        $this->url = strip_tags($this->url);
        // Eliminar espaços em branco
        $this->url = trim($this->url);
        // Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        // Eliminar caracteres
        $this->format['a'] = 'ÀÁÄÄÄÄÆÇÈÉÊËÎÍÎÏÐÑÒÓÕÕÖØÙÚÛÜüÝÞßääääääæçèéëëìíîïðñòóõõöøūūūýýþÿrr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºº ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }

    private function slugController($slugController)
    {
        //Converter para minúsculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o (-) em ( )
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        // Converter primeiras letras para maiusculas
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Remover o esspço em branco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        
        return $this->urlSlugController;
    }

    public function loadPage()
    {

        $classLoad = "\\Sts\\Controllers\\" . $this->urlController;
        $classPage = new $classLoad();
        $classPage->index();
    }
}