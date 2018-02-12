<?php
  include_once('conection.php');
  include_once("funcaoEnviaEmail.php");

  $data5dias =  date('Y-m-d', strtotime("+5 days"));
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
    $content .= '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#e7e5e7; margin:0; padding:0">';
    $content .= '  <tbody>';
    $content .= '    <tr>';
    $content .= '      <td>';
    $content .= '        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; background-color:#fff;'.$font.'">';
    $content .= '          <tbody>';
    $content .= '            <tr>';
    $content .= '              <td width="100%" style="background-color:#00b6c1; padding:25px 35px">';
    $content .= '                <table width="100%" height="33" cellpadding="0" cellspacing="0" border="0" align="left">';
    $content .= '                  <tbody>';
    $content .= '                    <tr>';
    $content .= '                      <td style="color:#fff; font-size:28px;letter-spacing: 1px;"><b>Aviso de Vencimento</b> </td>';
    $content .= '                    </tr>';
    $content .= '                  </tbody>';
    $content .= '                </table>';
    $content .= '              </td>';
    $content .= '            </tr>';
    $content .= '            <tr>';
    $content .= '              <td width="100%" style="background-color:#fff; padding:50px 35px">';
    $content .= '                <p style="letter-spacing: 1px; font-size:28px; margin-bottom:20px; margin-top:0; color:#000"><b>Prezado(a)  '.$result['display_name'].'.</b></p>';
    $content .= '                <p style="letter-spacing: 1px;font-size:16px; color:#5b5a5a; margin-bottom:30px; margin-top:0px">Faltam 5 dias para expirar seu acesso. Vencimento <strong>'.$dataFull.'</strong>.</p>';
    $content .= '                <p style="letter-spacing: 1px;font-size:16px; color:#5b5a5a; margin-bottom:10px; margin-top:0px">Seu acesso: <strong>'.$result['name'].'</strong>.</p>';
    $content .= '                <p style="letter-spacing: 1px;font-size:16px; color:#5b5a5a; margin-bottom:30px; margin-top:0px">Senha: <strong>'.$result['password'].' </strong>.</p>';
    $content .= '                <p style="letter-spacing: 1px;font-size:16px; color:#5b5a5a; margin-bottom:30px; margin-top:0px">Por favor, efetuar a renovação.</a></p>';
    $content .= '                <p style="text-align:center; margin-top:42px; margin-bottom: 20px"><a href="#" target="_blank" rel="noopener noreferrer" style="text-decoration:none; padding:12px 25px; background-color:#00b6c1; border-bottom:3px solid #00a2ad; color:#fff"><b>Renovar</b> </a></p>';
    $content .= '                <p style="letter-spacing: 1px;font-size:12px; color:#5b5a5a; margin-bottom:30px; margin-top:10px;">Clique no botão para acessar a página de renovação.</a></p>';
    $content .= '              </td>';
    $content .= '            </tr>';
    $content .= '          </tbody>';
    $content .= '        </table>';
    $content .= '      </td>';
    $content .= '    </tr>';
    $content .= '  </tbody>';
    $content .= '</table>';
    echo $content;
    //enviaEmail($result['email'], $email, $nome_de, $assunto, $content);
  }

?>
