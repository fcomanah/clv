<?
  $page_title = 'Finalizando Compra';  

  $valid = false;
  $shipping_errors = array();  
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    require ('check-validation.inc.php');
    if (empty($shipping_errors)) 
    {
    	$valid = true;   
    }
  }