<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  
  if(isset($_POST['id']))
  {
  	 
    include ('./includes/remove.inc.php');      
  }
  else 
  {
      $string = 'Location: create.php';
      header($string);
      exit;
  }
