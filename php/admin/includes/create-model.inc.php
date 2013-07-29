<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  require ('./includes/hf_functions.inc.php');
  require ('./includes/form_functions.inc.php');
  
  $page_title = 'Create';  

  $reg_errors = array();  
  $info = array();
  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    require ('validation.inc.php');
    if (empty($reg_errors)) 
    {
    	include ('./includes/create.inc.php');      
    }
  }
 
  $display_left_panel = false;
    $left_panel_href = 'left';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'left';

  $display_right_panel = false;
    $right_panel_href = 'right';
    $right_panel_data_icon = 'flat-menu';
    $right_panel_name = 'right';
  