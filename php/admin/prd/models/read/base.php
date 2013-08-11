<?
  require('./models/common.php');

  if(isset($_GET['id']))  	 
  {
    include ('./models/read/select.php');
  }
 
  $display_left_panel = true;
    $left_panel_href = 'lpanel';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'Ler '.$table;

  $display_right_panel = false;
    $right_panel_href = 'rpanel';
    $right_panel_data_icon = 'gear';
    $right_panel_name = 'Acesso Ráṕido';
  
