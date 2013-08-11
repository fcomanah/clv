<?
  require ('../../models/config.php');
  require (MYSQL);
  require ('../../models/functions/headfoot.php');
  require ('../../models/functions/form.php');
  $page_title = 'admin';  
  $reg_errors = array();

  if(isset($_GET['id']))  	 
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      require ('./models/update/validation.php');
      if (empty($reg_errors)) 
      {
    	  include ('./models/update/update.php');      
      }
    }
    include ('./models/read/select.php');
  }
 
  $display_left_panel = true;
    $left_panel_href = 'lpanel';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'Editar Usuário';

  $display_right_panel = false;
    $right_panel_href = 'rpanel';
    $right_panel_data_icon = 'gear';
    $right_panel_name = 'Acesso Rápido';
  
