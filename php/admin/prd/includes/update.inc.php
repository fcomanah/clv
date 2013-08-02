<?
  require(DBC);
  
  $q = "UPDATE prd SET";
  if(isset($n)) $q .= " nme = '".$n."'";
  $q .= " WHERE id_='".$_GET['id']."'";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
  $_GET['hgm']="Update efetuado com sucesso!";
