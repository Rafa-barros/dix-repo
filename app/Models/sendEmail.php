<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class sendEmail{

    public function mail($email, $id, $codigo){
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->SMTPDebug  = false;
            $mail->do_debug   = 0;
            $mail->Host       = 'dix.net.br';
            $mail->SMTPAuth   = false;
            $mail->Username   = 'admdix78@gmail.com';
            $mail->Password   = 'dixadm78';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
	        $mail->SMTPOptions = array(
              	'ssl' => array(
                		'verify_peer' => FALSE,
                		'verify_peer_name' => FALSE,
                		'allow_self_signed' => TRUE
              	)
    	    );
            $mail->CharSet    = 'UTF-8';

            //Recipients
            $mail->setFrom('admdix78@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Ativação de conta Dix';
            $mail->Body    = '<div class="card" style="background-color: #F7F7F7; height: 80vh; -webkit-box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75);
            -moz-box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75); 
            box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75); margin-left: auto; margin-right: auto; border: 1px #F7F7F7 solid; border-radius: 5%;">
                <img src="http://dix.net.br/app/View/assets/css/img/logo_blue.png" width="100px" height="100px" style="margin-left: 12vw;">
                <h1 style="text-align: center; font-family: Verdana; color:#0069d9">Ativação de conta</h1>
                <p style="text-align: center; font-family: Verdana;">Para ativação da sua conta, insira esse código:</p>
                <div style="margin-top: 15vh; width: 150px; height: 7vh; background-color: #cccccc; border: 1px #b6b6b6 solid; margin-left: 10vw; display: flex; align-items: center; justify-content: center">
                    <a style="font-family: Verdana; font-size: 25px;">' . $codigo . '</a>
                </div>
                <p style="text-align: center; font-family: Verdana; font-size: 10px; margin-top: 20vh;">Ou então, clique no link abaixo</p>
                <p style="font-family: Verdana; font-size: 9px; text-align: center; text-decoration: underline;"><a href="https://dix.net.br/verificarconta?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '"></a>https://dix.net.br/verificarconta?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '</div></p>
            </div>';
            $mail->AltBody = 'Para a Ativação de sua conta Dix, insira esse código ' . $codigo;

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }

    public function mailSenha($email, $id, $codigo){
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->SMTPDebug  = false;
            $mail->do_debug   = 0;
            $mail->Host       = 'dix.net.br';
            $mail->SMTPAuth   = false;
            $mail->Username   = 'admdix78@gmail.com';
            $mail->Password   = 'dixadm78';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->SMTPOptions = array(
                'ssl' => array(
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                        'allow_self_signed' => TRUE
                )
            );
            $mail->CharSet    = 'UTF-8';

            //Recipients
            $mail->setFrom('admdix78@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de senha Dix';
            $mail->Body    = '<div class="card" style="background-color: #F7F7F7; width: 30vw; height: 80vh; -webkit-box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75);
            -moz-box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75);
            box-shadow: -1px 10px 20px -6px rgba(0,0,0,0.75); margin-left: auto; margin-right: auto; border: 1px #F7F7F7 solid; border-radius: 5%;">
                <img src="http://dix.net.br/app/View/assets/css/img/logo_blue.png" width="100px" height="100px" style="margin-left: 12vw;">
                <h1 style="text-align: center; font-family: Verdana; color:#0069d9">Ativação de conta</h1>
                <p style="text-align: center; font-family: Verdana;">Para definir uma nova senha, insira esse código</p>
                <div style="margin-top: 15vh; width: 150px; height: 7vh; background-color: #cccccc; border: 1px #b6b6b6 solid; margin-left: 10vw; display: flex; align-items: center; justify-content: center">
                    <a style="font-family: Verdana; font-size: 25px;">' . $codigo . '</a>
                </div>
                <p style="text-align: center; font-family: Verdana; font-size: 10px; margin-top: 20vh;">Ou então, clique no link abaixo</p>
                <p style="font-family: Verdana; font-size: 9px; text-align: center; text-decoration: underline;"><a href="https://dix.net.br/recuperarsenha?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '"></a>https://dix.net.br/recuperarsenha?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '</div></p>
            </div>';
            $mail->AltBody = 'Para definir uma nova senha, insira esse código ' . $codigo;

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }

}
