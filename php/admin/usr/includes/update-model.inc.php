<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  require ('./includes/hf_functions.inc.php');
  require ('./includes/form_functions.inc.php');
  
  $page_title = 'Update';  
  $reg_errors = array();
  $info = array();

  if(isset($_GET['id']))  	 
  {
  	
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      require ('update-validation.inc.php');
      if (empty($reg_errors)) 
      {
    	  include ('./includes/update.inc.php');      
      }
    }
    
    include ('./includes/read.inc.php');

  	       
  }
 
  $display_left_panel = true;
    $left_panel_href = 'left';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'left';

  $display_right_panel = false;
    $right_panel_href = 'right';
    $right_panel_data_icon = 'flat-menu';
    $right_panel_name = 'right';
  