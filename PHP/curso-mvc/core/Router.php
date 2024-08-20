<?php

namespace core;

class Router {
    private $controller = 'Site'; // Armazena o nome do controlador padrão (classe principal)
    private $method = 'home'; // Armazena o método padrão (página) a ser acessado
    private $param = []; // Armazena parâmetros adicionais, caso necessários

    public function __construct(){
        $router = $this->url();
        // echo '<pre>';
        // print_r($router);

        if(file_exists('app/controllers/' . ucfirst($router[0]) . '.php')): // file_exists -> verifica se o arquivo existe //ucfirst -> coloca a primeira letra em maiuscula, ja q o nome da nossa classe é Site
        //     echo 'Arquivo existe!';
        // else:
        //     echo 'Arquivo NÃO existe!';
        $this->controller = $router[0];
        unset($router[0]);
        endif;

        $class = "\\app\\controllers\\" . ucfirst($this->controller);
        $object = new $class;

        if(isset($router[1]) and method_exists($class, $router[1])):
            $this->method = $router[1];
            unset($router[1]);
        endif;

        $this->param = $router ? array_values($router): []; //operação ternaria

        call_user_func_array([$object, $this->method], $this->param);
    }

    private function url(){ // Função privada para obter e processar a URL
        $parse_url = explode("/", filter_input(INPUT_GET, 'router', FILTER_SANITIZE_URL)); // Quebra a URL em partes usando "/" como delimitador e sanitiza a entrada
        return $parse_url;
    }
}