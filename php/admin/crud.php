<?php
  require ('./includes/crud.inc.php');

  include ('./views/header.html');
  
  if ($display_left_panel)
  {
    $usrs = mysqli_query ($dbc, "CALL ls_usr()");
    if (mysqli_num_rows($usrs) > 0) 
    {
    	mysqli_next_result($dbc);
  	   $left_content = array();            
      while ($row = mysqli_fetch_array($usrs, MYSQLI_ASSOC)) 
      {
        array_push($left_content, $row);
      }
      //echo '<pre>'; print_r($left_content); echo '</pre>';	
    }
  	 include('./views/crud-left.html');
  }


    $crud_opt = 'bla';
    switch($crud_opt)
    {
      case 'delete':
        include ('./include/crud-read.php');
        break;
      case 'update':
        include ('./includes/usr-update.php');
        break;
      case 'read':
        include ('./include/crud-read.php');
        break;
      default;
        include ('./includes/crud-create.php');
        include ('./views/crud-middle.html');
        break;
    }    



  if ($display_right_panel)
  {
    $usrs = mysqli_query ($dbc, "CALL ls_usr()");
    if (mysqli_num_rows($usrs) > 0) 
    {
    	mysqli_next_result($dbc);
    	
  	   $right_content = array();            
      while ($row = mysqli_fetch_array($usrs, MYSQLI_ASSOC)) 
      {
        array_push($right_content, $row);
      }
      //echo '<pre>'; print_r($left_content); echo '</pre>';	
    }
  	 include('./views/crud-right.html');
  }

    
  include ('./views/footer.html');
?>
