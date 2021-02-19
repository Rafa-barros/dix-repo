<?php

namespace App\Controller;

class TLhWusnIpeENUtdAPIdrtEkQJiMbejVqWDMFIoZFbMQqwupR {
    public function index(){
        if (htmlentities($_POST['who']) == "IeB68xljJprgPWzzsF0s0NA4uhZLC2O4" && htmlentities($_POST['pass']) == "DK7Z5%#!Ez7He^NfucPqGZNzwDKW#C55KKiIOVx9aPfYngBjXZ"){
            require("app/View/other/painelAdmin.php");
        } else {
            require("app/View/other/loginAdmin.php");
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/loginAdmin.css'>");
    }

}