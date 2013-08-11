<?
  require(DBC);
  
  $q = "UPDATE usr SET";
  if(isset($fn)) $q .= " first_name = '".$fn."'";
  if(isset($ln)) $q .= ", last_name = '".$ln."'";
  if(isset($p))  $q .= ", pass = '".get_password_hash($p)."'";
  $q .= " WHERE id_='".$_GET['id']."'";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
  if (mysqli_affected_rows($dbc) == 1)
  { 
    $string = 'Location: read.php?id=';
    $string .= $_GET['id'];
    $string .= '&hgm=Update executado com sucesso!';
    header($string);
    exit();
  }
  else
  {
    $_GET['hgm']="Nenhuma alteração foi feita.";
  }
