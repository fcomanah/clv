<?php
  if ($display_left_panel)
  {
    $left_content = array();
    require(DBC);
    $usrs = mysqli_query ($dbc, "CALL ls_usr()");
    if (mysqli_num_rows($usrs) > 0) 
    {
    	mysqli_next_result($dbc);
      while ($row = mysqli_fetch_array($usrs, MYSQLI_ASSOC)) 
      {
        array_push($left_content, $row);
      }
      //echo '<pre>'; print_r($left_content); echo '</pre>';	
    }
  	 include('./views/read-left.html');
  }
