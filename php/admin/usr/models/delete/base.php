<?
  require ('../../models/config.php');
  require (MYSQL);
  
  if(isset($_POST['id']))
  {
    include ('./models/delete/delete.php');      
  }
  else 
  {
    $string = 'Location: read.php';
    header($string);
    exit();
  }
