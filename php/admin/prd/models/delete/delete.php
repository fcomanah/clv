<?
  require(DBC);

  $id=$_POST['id'];
  $q = "DELETE FROM prd WHERE (( id_='$id' ))";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
  if (mysqli_affected_rows($dbc) == 1)
  { 
    $string = 'Location: read.php?';
    $string .= 'hgm=Remove efetuado com sucesso!';
    header($string);
    exit();
  }
  else
  { 
    $string = 'Location: update.php?id='.$id;
    $string .= '&hgm=Não foi possível remover o produto. Possivelmente, ele faz parte de algum carrinho...';
    header($string);
    exit();
  }
