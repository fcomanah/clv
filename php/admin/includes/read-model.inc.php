<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  require ('./includes/hf_functions.inc.php');
  require ('./includes/form_functions.inc.php');
  
  $page_title = 'Read';  
  $reg_errors = array();
  $info = array();

  	 if(isset($_GET['id']))  	 
    {
    	include ('./includes/read.inc.php');      
    }
 
  $display_left_panel = false;
    $left_panel_href = 'left';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'left';

  $display_right_panel = false;
    $right_panel_href = 'right';
    $right_panel_data_icon = 'flat-menu';
    $right_panel_name = 'right';
  