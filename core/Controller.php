<?php

namespace Core;

class Controller {
    private $url;
    private $urlController;
    private $urlMetodo;
    private $pag;
    private $dir;
    private $diretorios;

    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];
        $this->diretorios = explode("/", $this->url);

        if ($this->url != "/" && strpos($this->diretorios[1], "?") != 0){
            $this->urlController = $this->diretorios[1];
            if(strpos($this->urlController, "?") !== false){
                $this->urlController = substr($this->urlController, 0, strpos($this->urlController, '?'));
            }
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