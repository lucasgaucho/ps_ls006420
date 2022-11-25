<?php

namespace Petshop\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Petshop\Core\Exception as PetshopException;

class SendMail
{
  public static function enviar(string $paraNome, string $paraEmail, string $assunto, string $mensagem, string $replayToName = '', string $replayToEmail = '')
  {
    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = SMTP::DEBUG_OFF;
      $mail->isSMTP();
      $mail->Host       = MAIL_HOST;
      $mail->SMTPAuth   = true;
      $mail->Username   = MAIL_USER;
      $mail->Password   = MAIL_PASS;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = MAIL_PORT;

      //Recipients
      $mail->setFrom(MAIL_USER, MAIL_NAME);

      $mail->addAddress($paraEmail, $paraNome);

      if ($replayToName && $replayToEmail) {
        $mail->addReplyTo($replayToEmail, $replayToName);
      }

      $mail->isHTML(true);
      $mail->Subject = $assunto;
      $mail->Body    = $mensagem;
      $mail->AltBody = 'Esta mensagem está formatada com HTML, abra no navegador';

      if (!$mail->send()) {
        error_log('Erro de e-mail: ' . $mail->ErrorInfo);
        throw new PetshopException('Erro ao enviar a mensagem, tente novamente mais tarde');
      }

      return true;
    } catch (Exception $e) {
      error_log('Erro de e-mail: ' . $mail->ErrorInfo);
      throw new PetshopException('Erro do processo de envio de mensagem');
    }
  }
}