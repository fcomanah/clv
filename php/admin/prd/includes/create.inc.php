<?
  require(DBC);
   
  $q = "SELECT nme FROM prd WHERE nme='$n'";
  $r = mysqli_query ($dbc, $q);

  $rows = mysqli_num_rows($r);
	
  if ($rows == 0) 
  {
    $q = "INSERT INTO prd (nme) VALUES ('$n')";
    $r = mysqli_query ($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1)
    { // If it ran OK.
      // Send a separate email?
//				$body = "Thank you for registering at <whatever site>. Blah. Blah. Blah.\n\n";
//				mail($_POST['email'], 'Registration Confirmation', $body, 'From: admin@example.com');
      
      $string = 'Location: read.php?id=';
      $string .= mysqli_insert_id($dbc);
      $string .= '&hgm=Create executado com sucesso!';
      header($string);
      exit;
    }
    else
    { // If it did not run OK.
      trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
    }
  } 
  else 
  { 
    $reg_errors['nme'] = 'Esse nome de produto já existe. Tente outro. Ou atualize o existente.';
  } 
