<?php
  if ($display_left_panel)
  {
  	 require(DBC);
    $ctgs = mysqli_query ($dbc, "CALL ls_ctg()");    
    mysqli_next_result($dbc);
  	 include('./views/left.html');
  }
