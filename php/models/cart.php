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

  $car = array();
  
  $qcar = mysqli_query($dbc, "CALL ls_cart('$uid')");
  if (mysqli_num_rows($qcar) > 0) 
  {
    while ($row = mysqli_fetch_array($qcar, MYSQLI_ASSOC))
    {

      require(DBC);
      $qprd = "SELECT nme, prc FROM prd WHERE id_='".$row['id_prd']."'";
      $car_prd_mysql_object = mysqli_query ($dbc, $qprd);
      if (mysqli_num_rows($car_prd_mysql_object) > 0) 
      {
        $tmp = mysqli_fetch_array($car_prd_mysql_object, MYSQLI_ASSOC);
        $row["nme"] = $tmp['nme'];
        $row["prc"] = $tmp['prc'];
      }
      
      //print_r($row);
      //exit();
      
      array_push($car, $row);

    }
    /*
      echo '<pre>';
      print_r($car);
      echo '</pre>';
      exit();
    */ 
  }
