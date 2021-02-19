<?php

namespace App\Controller;

class LoginAdmin {
    public function index(){
        require("app/View/other/loginAdmin.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/loginAdmin.css'>");
    }

}