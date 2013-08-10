<?
  require ('./includes/config.inc.php');
  require (MYSQL);
  require ('./includes/hf_functions.inc.php');
    
  $page_title = 'client';
  
  $display_left_panel = true;
  $left_panel_href = 'menu';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'Categorias';

  $display_right_panel = true;
  $right_panel_href = 'cart';
  $right_panel_data_icon = 'cart';
  $right_panel_name = 'Carrinho';
    
  if (isset($_COOKIE['SESSION'])) 
  {
    $uid = $_COOKIE['SESSION'];
  } 
  else 
  {
    $uid = md5(uniqid('biped',true));
  }
  setcookie('SESSION', $uid, time()+(60*60*24*30));
