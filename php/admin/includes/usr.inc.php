<?php
  if (isset ($_GET['uid'])) 
  {
    $uid = $_GET['uid'];
   
    $qry = "CALL get_usr($uid)";
    $usr_info_mysql_object = mysqli_query ($dbc, $qry);
    mysqli_next_result($dbc);

    if (mysqli_num_rows($usr_info_mysql_object) > 0) 
    {
      $usr_info = mysqli_fetch_array($usr_info_mysql_object, MYSQLI_ASSOC);
    }
    
    if(isset($usr_info)) $page_title .= ' ' . $usr_info['nme'];
  }
