<?php

namespace App\Controller;

class TLhWusnIpeENUtdAPIdrtEkQJiMbejVqWDMFIoZFbMQqwupR {
    public function index(){
        if (htmlentities($_POST['who']) == "IeB68xljJprgPWzzsF0s0NA4uhZLC2O4" && htmlentities($_POST['pass']) == "DK7Z5%#!Ez7He^NfucPqGZNzwDKW#C55KKiIOVx9aPfYngBjXZ"){
            require('app/Models/loadAdmin.php');
            $admin = new \app\Models\Admin();

            if (isset($_POST['id'])){
                $admin->setValue($_POST['id'], 'id');
            }
            if (isset($_POST['key'])){
                $admin->setValue($_POST['key'], 'chave');
            }
            if (isset($_POST['email'])){
                $admin->setValue($_POST['email'], 'email');
            }
            if (isset($_POST['token'])){
                $admin->setValue($_POST['token'], 'token');
            }
            if (isset($_POST['porcentagem'])){
                $admin->setValue($_POST['porcentagem'], 'porcentagem');
            }
            $admin->getTable();

            require("app/View/other/painelAdmin.php");
        } else {
            require("app/View/other/loginAdmin.php");
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/loginAdmin.css'>");
    }

}