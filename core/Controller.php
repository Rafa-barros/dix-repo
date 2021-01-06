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

        switch(count($this->diretorios)){
            case 1:
                $this->urlController = "index";
                break;
            case 3:
                $this->urlMetodo = $this->diretorios[2];
            case 2:
                $this->urlController = $this->diretorios[1];
                break;
        }
    }

    public function carregar(){
        $dir = ucfirst($this->urlController);
        $pag = "\\App\\Controller\\" . $dir;
        $paginaCarregada = new $pag;
        $paginaCarregada->index();
    }
}