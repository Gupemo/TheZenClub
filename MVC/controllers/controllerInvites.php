<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/invitations.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/PHPMailer/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/PHPMailer/SMTP.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/PHPMailer/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/.env.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControllerInvites {

    public function invitarUsuario($email) {
        // Comprobar si ya existe registro
        if (Invites::comprobarUsuario($email)) {
            return false;
        }

        // Comprobar si ya tiene invitación
        if (Invites::comprobarInvitacion($email)) {
            return false;
        }

        // Generar token
        $token = bin2hex(random_bytes(16));

        // Crear invitación en BD
        $creada = Invites::crearInvitacion($email, $token);

        if ($creada) {
            // Preparar correo
            $url = "https://thezenclub.es/views/registro.php?token=$token";

            $asunto = "Invitación a The Zen Club";
            $cuerpoHtml = "
                <h2>Invitacion a registro en -<strong>The Zen Club</strong>-</h2>
                <p>Has recibido este email, debido a que has sido invitado para registrarte en nuestra web.</p>
                <p><a href='$url'>haz click en este enlace</a> para registrarte.</p>
                <p>Si no puedes hacer click, copia el siguiente enlace:</p>
                <p>$url</p>
            ";

            // Enviar correo
            return $this->enviarCorreo($email, $asunto, $cuerpoHtml);
        }

        return false;
    }

    public function listarInvitaciones() {
        return Invites::obtenerInvitaciones();
    }

    public function comprobarToken($token) {
        $invitacion = Invites::comprobarToken($token);
        return $invitacion ?: false;
    }

private function enviarCorreo($destinatario, $asunto, $cuerpoHtml, $cuerpoTexto = '') {
    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION; // 'tls'
        $mail->Port       = MAIL_PORT;       // 587

        // solo para lan
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true
            ]
        ]; 

        // Remitente
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        // Destinatario
        $mail->addAddress($destinatario);

        // Contenido
        $mail->isHTML(true);
        $mail->CharSet  = 'UTF-8';    // asegura tildes y ñ
        $mail->Encoding = 'base64';   // evita que se rompan caracteres especiales
        $mail->Subject  = $asunto;
        $mail->Body     = $cuerpoHtml;
        $mail->AltBody  = $cuerpoTexto ?: strip_tags($cuerpoHtml);

        return $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar correo: " . $mail->ErrorInfo);
        return false;
    }
}


    public function reenviarInvitacion($id) {
        $invitacion = Invites::obtenerPorId($id);

        if ($invitacion) {
            $url = "https://thezenclub.es/views/registro.php?token=" . $invitacion['token'];

            $asunto = "Reenvío de invitación - The Zen Club";
            $cuerpoHtml = "
                <h2>Reenvio de la invitación</h2>
                <p>Haz clic en el enlace para registrarte:</p>
                <p><a href='$url'>Click aquí.</a></p>
                <p>Si no puedes hacer click, copia el siguiente enlace: $url</p>
            ";

            return $this->enviarCorreo(
                $invitacion['email'],
                $asunto,
                $cuerpoHtml
            );
        }

        return false;
    }

}
