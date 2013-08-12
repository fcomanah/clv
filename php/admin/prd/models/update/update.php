<?
  require(DBC);
   
  $q = "UPDATE prd SET";
  if(isset($nme)) $q .= " nme = '".$nme."'";
  if(isset($prc)) $q .= ", prc = '".$prc."'";
  if(isset($dsc)) $q .= ", dsc = '".$dsc."'";
  if(isset($stq)) $q .= ", stq = '".$stq."'";
  if(isset($img)) $q .= ", img = '".$img."'";
  if(isset($ctg)) $q .= ", id_ctg = '".$ctg."'";
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
