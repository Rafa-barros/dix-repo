<?php

namespace Core;

class Controller {
    private string $url;
    private string $urlController;
    private string $urlMetodo;
    private array $diretorios;

    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];
        $this->diretorios = explode("/", $this->url);

        if ($this->url != "/"){
            $this->urlController = $this->diretorios[1];
            if (count($this->diretorios) == 3){
                $this->urlMetodo = $this->diretorios[2];
            }
        } else {
            $this->urlController = "home";
        }
    }

    public function carregar(){
        $dir = ucfirst($this->urlController);
        if (class_exists("\\App\\Controller\\" . $dir)){
            $pag = "\\App\\Controller\\" . $dir;
        } else {
            $pag = "\\App\\Controller\\Error404";
        }
        $paginaCarregada = new $pag;
        $paginaCarregada->index();
    }
}