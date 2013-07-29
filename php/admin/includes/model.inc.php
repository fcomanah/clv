<?php
  require ('./includes/config.inc.php');
  require (MYSQL);
  require ('./includes/hf_functions.inc.php');
  require ('./includes/form_functions.inc.php');
  
  $reg_errors = array();    

  $page_title = 'crud';  
  
  $info = array();
    
  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    require ('validation.inc.php');
    if (empty($reg_errors)) 
    {
    	echo 'ok';      
    }
  }

  //if(isset($info)) $page_title .= ' ' . $info['nme'];
  
  $display_left_panel = true;
  $left_panel_href = 'left';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'left';

  $display_right_panel = true;
  $right_panel_href = 'right';
  $right_panel_data_icon = 'flat-menu';
  $right_panel_name = 'right';
  