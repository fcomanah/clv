<?
  require ('../../models/config.php');
  require (MYSQL);
  require ('../../models/functions/headfoot.php');
  require ('../../models/functions/form.php');
  $page_title = 'admin';  
  $reg_errors = array();  

  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    require ('./models/create/validation.php');
    
    if (empty($reg_errors)) 
    {
    	include ('./models/create/insert.php');
    }
  }
 
  $display_left_panel = false;
    $left_panel_href = 'lpanel';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'Menu Principal';

  $display_right_panel = false;
    $right_panel_href = 'rpanel';
    $right_panel_data_icon = 'gear';
    $right_panel_name = 'Acesso Rápido';
  
