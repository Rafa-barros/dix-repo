<?php

namespace Core;

class Controller {
    private string $url;
    private string $urlController;
    private string $urlMetodo;
    private string $pag;
    private string $dir;
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

        $this->dir = ucfirst($this->urlController);
        if (class_exists("\\App\\Controller\\" . $this->dir)){
            $this->pag = "\\App\\Controller\\" . $this->dir;
        } else {
            $this->pag = "\\App\\Controller\\Error404";
        }
    }

    public function carregarCSS(){
        $cssLoad = new $this->pag;
        $cssLoad->carregarCSS();
    }

    public function carregar(){
        $paginaCarregada = new $this->pag;
        $paginaCarregada->index();
    }
}