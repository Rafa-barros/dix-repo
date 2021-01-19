<?php

namespace App\Controller;

class Login {
    public function index(){
        /*
        Aqui vai ser iniciado o processo de login, pode criar funções private e public para montar
        o registro e login do usuário em md5 hash, lembrando sempre de configurar o objeto da database que vai receber
        pelo Model.

        Também pode colocar um require da view da página :).
        */
        $dbLogin = new \App\Models\loginUsuario();
        $dbLogin->Login();
        echo "Teste login";
    }
}