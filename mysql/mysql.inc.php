<?php
  DEFINE ('DB_USER', 'clv');
  DEFINE ('DB_PASSWORD', 'clv');
  DEFINE ('DB_HOST', 'localhost');
  DEFINE ('DB_NAME', 'clv');

  require('dbc.inc.php');
  
function get_password_hash($password) {
	
	// Need the database connection:
	global $dbc;

	// Return the escaped password:
	return mysqli_real_escape_string ($dbc, hash_hmac('sha256', $password, 'c#haRl891', true));
	
} // End of get_password_hash() function.