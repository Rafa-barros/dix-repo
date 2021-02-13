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
            $mail->SMTPDebug  = true;
            $mail->do_debug   = 1;
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
            $mail->Body    = '<div class="jorge" style="background-color: #fafafa;">Para a Ativação de sua conta Dix, insira esse código<br>
                            ' . $codigo . '<br>
                            Ou então clique aqui!<br>
                            <a href="http://dix.net.br/verificarconta?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '"><button>verificar</button></a></div>';
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
            $mail->SMTPDebug  = true;
            $mail->do_debug   = 1;
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
            $mail->Body    = '<div class="jorge" style="background-color: #fafafa;">Para definir uma nova senha, insira esse código<br>
                            ' . $codigo . '<br>
                            Ou então clique aqui!<br>
                            <a href="http://dix.net.br/recuperarsenha?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '"><button>verificar</button></a></div>';
            $mail->AltBody = 'Para definir uma nova senha, insira esse código ' . $codigo;

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }

}
