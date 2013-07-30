<?
  require(DBC);

  $id=$_POST['id'];
  $q = "DELETE FROM usr WHERE (( id_='$id' ))";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
      $string = 'Location: create.php?';
      $string .= 'hgm=Remove efetuado com sucesso!';
      header($string);
      exit;
