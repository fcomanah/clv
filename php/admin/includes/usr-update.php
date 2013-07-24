<?php
  if (empty($reg_errors)) { // If everything's OK...
    require(DBC);

    // Temporary: set expiration to a month!
    $q = "UPDATE usr SET pass = '"  .  get_password_hash($p) .  "', first_name = '$fn', last_name = '$ln', date_expires = ADDDATE(NOW(), INTERVAL 1 MONTH) WHERE nme = '$u'";
    $r = mysqli_query ($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1) 
    { // If it ran OK.
  //  Send a separate email?
  //  $body = "Thank you for registering at <whatever site>. Blah. Blah. Blah.\n\n";
  //  mail($_POST['email'], 'Registration Confirmation', $body, 'From: admin@example.com');
      if(isset($usr_info)) 
        include ('./views/usr-update-middle.html');
      else 
        include ('./views/usr-create-middle.html');
				
    } else { // If it did not run OK.
		trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
    }
  }