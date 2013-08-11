<?
  require ('../models/config.php');
  require (MYSQL);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    include ('./models/login.php');
  }
  require ('../models/functions/headfoot.php');
  require ('../models/functions/form.php');
  
  $reg_errors = array();    

  $page_title = 'admin';  
  
  $info = array();
    
  $display_left_panel = false;
  $left_panel_href = 'lmenu';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'Menu Principal';

  $display_right_panel = false;
  $right_panel_href = 'rmenu';
  $right_panel_data_icon = 'gear';
  $right_panel_name = 'Acesso Rápido';
  
