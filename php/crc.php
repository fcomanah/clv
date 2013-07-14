<?php
  //require ('./includes/config.inc.php');

  $page_title = 'crc';
  
  $display_left_panel = true;
  $left_panel_href = 'menu';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'Categorias';

  $display_right_panel = false;
  $right_panel_href = 'cart';
  $right_panel_data_icon = 'cart';
  $right_panel_name = 'Carrinho';
  
  require ('./includes/header_functions.inc.php');
  include ('./includes/header.html');

    //require (MYSQL);
    //$r = mysqli_query ($dbc, "CALL select_sale_items(false)");

    if ($display_left_panel) include('./views/left.html');
    include('./views/middle.html');
    if ($display_right_panel) include('./views/right.html');

  include ('./includes/footer.html');
?>
