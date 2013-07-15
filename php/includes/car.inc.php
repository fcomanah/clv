<?php
  if (isset ($_GET['id'], $_GET['action']) && ($_GET['action'] == 'add') ) 
  {
	$pid = $_GET['id'];
    $car = mysqli_query($dbc, "CALL add_to_car('$uid', '$pid', 1)");
	
	// For debugging purposes:
	//if (!$r) echo mysqli_error($dbc);
		
  } 
  elseif (isset ($_GET['id'], $_GET['action']) && ($_GET['action'] == 'remove') ) 
  { // Remove it from the cart.
	
    //	$r = mysqli_query($dbc, "CALL remove_from_cart('$uid', '$sp_type', $_GET['id'])");

  }
  elseif (isset ($_GET['id'], $_GET['action'], $_GET['qty']) && ($_GET['action'] == 'move') ) 
  { // Move it to the cart.
	// Determine the quantity:
	$qty = (filter_var($_GET['qty'], FILTER_VALIDATE_INT, array('min_range' => 1))) ? $_GET['qty'] : 1;
	
	// Add it to the cart:
//	$r = mysqli_query($dbc, "CALL add_to_cart('$uid', '$sp_type', $_GET['id'], $qty)");
	
	// Remove it from the wish list:
//	$r = mysqli_query($dbc, "CALL remove_from_wish_list('$uid', '$sp_type', $_GET['id'])");

  }
  elseif (isset($_POST['quantity'])) 
  { // Update quantities in the cart.
	// Loop through each item:
	foreach ($_POST['quantity'] as $id_ => $qty) 
	{
		if (isset($_GET['id'])) 
		{
			// Determine the quantity:
			$qty = (filter_var($qty, FILTER_VALIDATE_INT, array('min_range' => 0)) !== false) ? $qty : 1;
			// Update the quantity in the cart:
//			$r = mysqli_query($dbc, "CALL update_cart('$uid', '$sp_type', $_GET['id'], $qty)");
		}
	} // End of FOREACH loop.	
  }// End of main IF.

  $car = mysqli_query($dbc, "CALL ls_car('$uid')");
