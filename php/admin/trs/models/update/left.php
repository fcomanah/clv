<?php
  if ($display_left_panel)
  {
    $left_content = array();
    require(DBC);
    $trs = mysqli_query ($dbc, "CALL ls_trs()");
    if (mysqli_num_rows($trs) > 0) 
    {
    	mysqli_next_result($dbc);
      while ($row = mysqli_fetch_array($trs, MYSQLI_ASSOC)) 
      {
        array_push($left_content, $row);
      }
      //echo '<pre>'; print_r($left_content); echo '</pre>';	
    }
  	 include('./views/update-left.html');
  }
