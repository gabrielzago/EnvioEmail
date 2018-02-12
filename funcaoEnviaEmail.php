<?php
  include_once("email/phpmailer/class.phpmailer.php");
  include_once("email/phpmailer/setEmail.php");

  $setEmail = new paramEmail();
  $emailParam = $setEmail->email();
  $senhaParam = $setEmail->senha();
  $hostParam = $setEmail->host();

  define('GUSER', $emailParam);
  define('GPWD', $senhaParam);

  function enviaEmail($para, $de, $de_nome, $assunto, $corpo) {
      global $error;
      $mail = new PHPMailer();
      $mail->IsSMTP();        // Ativar SMTP
      $mail->SMTPDebug = 0;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
      $mail->SMTPAuth = true;     // Autenticação ativada
      $mail->SMTPSecure = 'ssl';
     // $mail->SMTPSecure = 'tls';  // SSL REQUERIDO pelo GMail
      //$mail->Host = $host;   // SMTP utilizado
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;          // A porta 587 deverá estar aberta em seu servidor
      $mail->Username = GUSER;
      $mail->Password = GPWD;
      $mail->SetFrom($de, $de_nome);
      $mail->Subject = utf8_decode($assunto);
      $mail->Body = utf8_decode($corpo);
      $mail->IsHTML(true);
      $mail->AddAddress($para);
      if(!$mail->Send()) {
          $error = 'Mail error: '.$mail->ErrorInfo;
          return false;
      } else {
          $error = 'Mensagem enviada!';
          return true;
      }
  }

?>
