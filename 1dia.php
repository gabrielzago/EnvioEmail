<?php
  include_once('conection.php');
  include_once("funcaoEnviaEmail.php");

  $data5dias =  date('Y-m-d', strtotime("+1 days"));
  $assunto = "";
  $nome_de = "Aviso de vencimento";
  $email = "sistema@sistema.com.br";

  $sql = "Select name, password, display_name, expire_date, email from dados_import where expire_date = '$data5dias'";
  $resSql = query($sql);

  foreach ($resSql as $result) {
    $date = date_create($result['expire_date']);
    $ano = date_format($date, 'Y');
    $mes = date_format($date, 'm');
    $dataFull = date_format($date, 'd/m/Y');

    /* HTML */
    $content .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml">';
    $content .= ' <head>';
    $content .= '  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"/>';
    $content .= '       <title>Aviso de 1 dia.</title>';
    $content .= ' </head>';
    $content .= ' <body>';
    $content .= '<div><h2>Aviso de 1 dia</h2></div>';
    $content .= '  Prezado(a) <strong>'.$result['display_name'].'</strong><br /><br />';
    $content .= '  Seu acesso: <strong>'.$result['name'].' </strong> vencerá dia: <strong>'.$dataFull.'</strong>.<br/><br/>';
    $content .= '  Por favor, efetuar a renovação.';
    $content .= '    <hr />';
    $content .= ' </body>';
    $content .= '</html>';
    echo $content;
    //  enviaEmail($result['email'], $email, $nome_de, $assunto, $content);
  }

?>
