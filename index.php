<?php
  include_once('conection.php');

  $sql = "Select name, password, display_name, expire_date from dados_import";
  $resSql = query($sql);

  var_dump($resSql);

?>
