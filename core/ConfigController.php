<?php

namespace Core;

if(!defined('C7E3L8K9E5')){
    header('Location: /');
    die("Erro: Página não encontrada!");
  }

/**
 * Recebe a URL e manipula
 * Carregar a CONTROLLER
 * 
 * @author Eduardo <eduardolima.tecnico@gmail.com>
 */
class ConfigController extends Config
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;
    private string $urlController;
    /** @var string $urlParameterv */ 
    private string $urlSlugController;
    private array $format;

    /**
     * Recebe a URL do .htaccess
     * Validar a URL
     */
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

    }

    /**
     * Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URLre retirar os caracteres especiais.
     *
     * @return void
     */
    private function clearUrl(): void
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

    /**
     * Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa". 
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     *
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa"
     */
    private function slugController($slugController): string
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

    /**
     * Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     *
     * @return void
     */
    public function loadPage(): void
    {

        $classLoad = "\\Sts\\Controllers\\" . $this->urlController;
        $classPage = new $classLoad();
        $classPage->index();
    }
}