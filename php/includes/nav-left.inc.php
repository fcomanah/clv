<?php
  if ($display_left_panel)
  {
  	require(DBC);
  	$ctg_id = $_GET['id'];
    $ctgs = mysqli_query ($dbc, "CALL ls_ctg_flh('$ctg_id')");
    mysqli_next_result($dbc);
  	include('./views/left.html');
  }
