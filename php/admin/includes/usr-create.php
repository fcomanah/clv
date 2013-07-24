<?php
  $reg_errors = array();
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    require ('usr-validation.inc.php');
    
    if (empty($reg_errors)) 
    {
    	 require(DBC);
 
      // Make sure the email address and username are available:
      $q = "SELECT email, nme FROM usr WHERE email='$e' OR nme='$u'";
      $r = mysqli_query ($dbc, $q);

      // Get the number of rows returned:
      $rows = mysqli_num_rows($r);
	
      if ($rows == 0) 
      {
         // Add the user to the database...
			
         // Temporary: set expiration to a month!
         $q = "INSERT INTO usr (nme, email, pass, first_name, last_name, date_expires) VALUES ('$u', '$e', '"  .  get_password_hash($p) .  "', '$fn', '$ln', ADDDATE(NOW(), INTERVAL 1 MONTH) )";
         $r = mysqli_query ($dbc, $q);

         if (mysqli_affected_rows($dbc) == 1)
         { // If it ran OK.
			
				// Send a separate email?
//				$body = "Thank you for registering at <whatever site>. Blah. Blah. Blah.\n\n";
//				mail($_POST['email'], 'Registration Confirmation', $body, 'From: admin@example.com');
           header('Location: usr.php?uid=3');
           exit;
         }
         else
         { // If it did not run OK.
           trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
         }
      } 
      else 
      { // The email address or username is not available.
        if ($rows == 2)
        { // Both are taken.
          $reg_errors['email'] = 'This email address has already been registered.';			
          $reg_errors['nme'] = 'This username has already been registered. Please try another.';			
        }
        else 
        { // One or both may be taken.
          // Get row:
          $row = mysqli_fetch_array($r, MYSQLI_NUM);
							
          if( ($row[0] == $_POST['email']) && ($row[1] == $_POST['nme'])) 
          { // Both match.
            $reg_errors['email'] = 'This email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.';	
            $reg_errors['nme'] = 'This username has already been registered with this email address. If you have forgotten your password, use the link at right to have your password sent to you.';
          }
          elseif ($row[0] == $_POST['email']) 
          { // Email match.
            $reg_errors['email'] = 'This email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.';						
          } 
          elseif ($row[1] == $_POST['nme']) 
          { // Username match.
            $reg_errors['nme'] = 'This username has already been registered. Please try another.';			
          }			
        }		
      } 
    }
  }
