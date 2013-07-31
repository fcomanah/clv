<? 
  // Array for recording errors:
  $login_errors = array();

  // Validate the email address:
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	  $e = mysqli_real_escape_string ($dbc, $_POST['email']);
  } else {
	  $login_errors['email'] = 'Please enter a valid email address!';
  }

  // Validate the password:
  if (!empty($_POST['pass'])) {
	  $p = mysqli_real_escape_string ($dbc, $_POST['pass']);
  } else {
  	$login_errors['pass'] = 'Please enter your password!';
  }
	
  if (empty($login_errors)) { // OK to proceed!

	  // Query the database:
	  $q = "SELECT id_, nme, type, IF(date_expires >= NOW(), true, false) FROM usr WHERE (email='$e' AND pass='"  .  get_password_hash($p) .  "')";		
	  $r = mysqli_query ($dbc, $q);
	
	  if (mysqli_num_rows($r) == 1) { // A match was made.
		
		  // Get the data:
		  $row = mysqli_fetch_array ($r, MYSQLI_NUM); 
		
		  // If the user is an administrator, create a new session ID to be safe:
		  // This code is created at the end of Chapter 4:
		  if ($row[2] == 'admin') {
			  session_regenerate_id(true);
			  $_SESSION['user_admin'] = true;
		  }
		
		  // Store the data in a session:
		  $_SESSION['id'] = $row[0];
		  $_SESSION['nme'] = $row[1];
		
		  // Only indicate if the user's account is not expired:
		  if ($row[3] == 1) $_SESSION['user_not_expired'] = true;
		  
		  $_GET['hgm'] = 'Login efetuado com sucesso!';
			
	  } 
	  else 
	  { // No match was made.
		  $login_errors['login'] = 'The email address and password do not match those on file.';
	  }
	
  } // End of $login_errors IF.

// Omit the closing PHP tag to avoid 'headers already sent' errors!
