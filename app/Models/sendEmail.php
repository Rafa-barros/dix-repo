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
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'admdix78@gmail.com';
            $mail->Password   = 'dixadm78';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            //Recipients
            $mail->setFrom('admdix78@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Ativação de conta Dix';
            $mail->Body    = '<div class="jorge" style="background-color: blue;">Para a Ativação de sua conta Dix, insira esse código<br>
                            ' . $codigo . '<br>
                            Ou então clique aqui!<br>
                            <a href="http://localhost:8080/verificarConta?id=' . $id . '&email=' . $email . '&codigo=' . $codigo . '"><button>verificar</button></a></div>';
            $mail->AltBody = 'Para a Ativação de sua conta Dix, insira esse código ' . $codigo;

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }

}