<?php
  DEFINE ('DB_USER', 'clv');
  DEFINE ('DB_PASSWORD', 'clv');
  DEFINE ('DB_HOST', 'localhost');
  DEFINE ('DB_NAME', 'clv');

  // Make the connection:
  $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Set the character set:
  mysqli_set_charset($dbc, 'utf8');

// Omit the closing PHP tag to avoid 'headers already sent' errors!
