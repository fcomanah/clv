<?php
  if (isset ($_POST['slider'], $_GET['id'], $_GET['action']) && ($_GET['action'] == 'add') ) 
  {
	 $pid = $_GET['id'];
	 $qtd = $_POST['slider'];
    $car = mysqli_query($dbc, "CALL add_to_cart('$uid', '$pid', '$qtd')");
	
	// For debugging purposes:
	//if (!$r) echo mysqli_error($dbc);
		
  } 
  elseif (isset ($_POST['slider'], $_GET['id'], $_GET['action']) && ($_GET['action'] == 'rm') ) 
  { // Remove it from the cart.
	
	 $cid = $_GET['id'];
	 $qtd = $_POST['slider'];
    $r = mysqli_query($dbc, "CALL remove_from_cart('$cid', '$qtd')");

  }

  $car = mysqli_query($dbc, "CALL ls_cart('$uid')");