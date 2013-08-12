<?
  require(DBC);
 
  $q = "INSERT INTO prd (nme, prc, dsc, id_ctg, img, stq) VALUES ('$nme', '$prc', '$dsc', '$ctg', '$img', '$stq')";
  $r = mysqli_query ($dbc, $q);

  if (mysqli_affected_rows($dbc) == 1)
  { 
    $string = 'Location: read.php?id=';
    $string .= mysqli_insert_id($dbc);
    $string .= '&hgm=Create executado com sucesso!';
    header($string);
    exit();
  }
  else
  { 
    $string = 'Location: read.php?id=';
    $string .= mysqli_insert_id($dbc);
    $string .= '&hgm=Não foi possível o registro por conta de uma falha no sistema.';
    header($string);
    exit();
  }
