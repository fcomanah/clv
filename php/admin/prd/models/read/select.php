<?
  require(DBC);
  
  $q = "SELECT * FROM prd WHERE id_='".$_GET['id']."'";
  $info_mysql_object = mysqli_query ($dbc, $q);
  
  //mysqli_next_result($dbc);

  if (mysqli_num_rows($info_mysql_object) > 0) 
  {
    $info = mysqli_fetch_array($info_mysql_object, MYSQLI_ASSOC);
  }


  $q = "SELECT nme FROM ctg WHERE id_='".$info['id_ctg']."'";
  $info_mysql_object = mysqli_query ($dbc, $q);
  if (mysqli_num_rows($info_mysql_object) > 0) 
  {
    $tmp = mysqli_fetch_array($info_mysql_object, MYSQLI_ASSOC);
    $info['ctg'] = $tmp['nme'];
  }
  
