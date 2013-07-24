<?php
  $qry = "CALL get_crud($id_)";
  $info_mysql_object = mysqli_query ($dbc, $qry);
  mysqli_next_result($dbc);

  if (mysqli_num_rows($info_mysql_object) > 0) 
  {
    $info = mysqli_fetch_array($info_mysql_object, MYSQLI_ASSOC);
  }
    