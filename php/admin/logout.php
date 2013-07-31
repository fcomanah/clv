<?
  require ('./includes/config.inc.php');
  
  redirect_invalid_user();
  
  // Destroy the session:
  $_SESSION = array(); // Destroy the variables.
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
  }
  session_destroy(); // Destroy the session itself.
  

	$url = './';
	header("Location: $url");
	exit(); // Quit the script.
?>
