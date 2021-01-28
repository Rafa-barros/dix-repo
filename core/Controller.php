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
        $nDiretorios = count($this->diretorios) - 1;
        for($i = 0; $i <= $nDiretorios; $i++){ 
        	$get = strpos($this->diretorios[$i], '?');
        	if($get !== false && $i <= $nDiretorios){
        		$toImp = array();
        		for($j = $i, $k = 0; $j <= $nDiretorios; $j++, $k++){
        			if($j < ($nDiretorios - 1)){
        				$toImp[$k] = $this->diretorios[$j] . "/";
        			}else{
        				$toImp[$k] = $this->diretorios[$j];
        			}
        			unset($this->diretorios[$j]);
        		}
        		$this->diretorios[$i] = implode($toImp);
        		$nDiretorios = $i;
        		break;
        	}
        }
        if ($this->url != "/" && $get === false){
            $this->urlController = $this->diretorios[1];
            if (count($this->diretorios) == 3){
                $this->urlMetodo = $this->diretorios[2];
            }
        } else {
        	if($get === 0 || $this->url == "/"){
        		$this->urlController = "home";
        	}else{
            	$this->urlController = substr($this->diretorios[$nDiretorios], 0, strpos($this->diretorios[$nDiretorios], '?'));
        	}
        }        $this->dir = ucfirst($this->urlController);
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