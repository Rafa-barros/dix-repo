<?php

namespace App\Controller;

class Error404 {
    public function index(){
        echo ("Erro 404 Not Found");
    }

    public function carregarCSS(){
        /*
        * ENCAMINHAR UM REQUIRE PARA O CSS DA PÁGINA EM TODO CONTROLADOR
        */
    }
}