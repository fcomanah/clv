<?
  require(DBC);
 
  $q = "INSERT INTO ctg (nme) VALUES ('$ctg_nme')";
  $r = mysqli_query ($dbc, $q);
  
  $id = mysqli_insert_id ($dbc);
  
  $q = "INSERT INTO mnu (id_ctg_flh, id_ctg_pai) VALUES ('$id','$ctg_pai')";
  $r = mysqli_query ($dbc, $q);
