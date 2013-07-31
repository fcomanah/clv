<?
  require(DBC);
  
  $q = "UPDATE usr SET";
  if(isset($fn)) $q .= " first_name = '".$fn."'";
  if(isset($fn)) $q .= ", last_name = '".$ln."'";
  if(isset($p))  $q .= ", pass = '".get_password_hash($p)."'";
  $q .= " WHERE id_='".$_GET['id']."'";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
  $_GET['hgm']="Update efetuado com sucesso!";
