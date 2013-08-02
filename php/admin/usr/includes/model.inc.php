<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    include ('./includes/login.inc.php');
  }
  require ('./includes/hf_functions.inc.php');
  require ('./includes/form_functions.inc.php');
  
  $reg_errors = array();    

  $page_title = 'usr';  
  
  $info = array();
    
  $display_left_panel = true;
  $left_panel_href = 'left';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'menu';

  $display_right_panel = false;
  $right_panel_href = 'right';
  $right_panel_data_icon = 'flat-menu';
  $right_panel_name = 'right';
  
