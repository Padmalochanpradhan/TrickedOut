<?php

namespace App\Libraries;

require_once APPPATH . 'Libraries/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'Libraries/PHPMailer/src/SMTP.php';
require_once APPPATH . 'Libraries/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function sendMail($to, $subject, $body, $bcc='', $fromEmail = 'info.trickedoutmagic@gmail.com', $fromName = 'Tricked Out')
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            // $mail->Host       = 'smtp.office365.com';
            // $mail->SMTPAuth   = true;
            // $mail->Username   = 'info@trickedoutmagic.com';
            // $mail->Password   = 'cQ!Jc67aHKDzg7DNSES#gDx@';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // $mail->Port       = 587;

            // $mail->Host       = 'smtp.gmail.com';
            // $mail->SMTPAuth   = true;
            // $mail->Username   = 'supersalesblitz.2025@gmail.com';
            // $mail->Password   = 'cqhtbpudlxlmppwi';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // $mail->Port       = 587;

            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info.trickedoutmagic@gmail.com';
            $mail->Password   = 'ehligrqyvlsubjxn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            if (!empty($bcc)) {
                $mail->addBCC($bcc);
            }

            // Recipients
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
