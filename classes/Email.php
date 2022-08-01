<?php

namespace Classes;

use Dotenv\Dotenv as Dotenv;
$dotenv = Dotenv::createImmutable('../includes/.env');
$dotenv->safeLoad();
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de email

        $mail = new PHPMailer();
        // Protocolo de envio de email
        $mail->isSMTP();
        $mail->Host = $_ENV["MAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["MAIL_PORT"];
        $mail->Username = $_ENV["MAIL_USER"];
        $mail->Password = $_ENV["MAIL_PASS"];

        $mail->setFrom($_ENV["MAIL_USER"], 'APPSALON');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = "Confirma tu cuenta";

        // Set HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href=". $_ENV['SERVER_HOST'] . "confirmar-cuenta?token=" . $this->token . ">Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail

        $mail->send();
    }

    public function enviarInstrucciones()
    {

        // Crear el objeto de email

        $mail = new PHPMailer();
        // Protocolo de envio de email
        $mail->isSMTP();
        $mail->Host = $_ENV["MAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["MAIL_PORT"];
        $mail->Username = $_ENV["MAIL_USER"];
        $mail->Password = $_ENV["MAIL_PASS"];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = "Restablece tu password";

        // Set HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado restablecer tu password sigue el suigiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aquí: <a href=". $_ENV['SERVER_HOST'] . "recuperar?token=" . $this->token . ">Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail

        $mail->send();
    }
}
