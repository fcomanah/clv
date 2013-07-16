<?php
  //require ('./includes/config.inc.php');

  $page_title = 'dsc';
  
  $display_left_panel = true;
  $left_panel_href = 'prd';
  $left_panel_data_icon = 'flat-menu';
  $left_panel_name = 'Produtos';

  require ('./includes/hf_functions.inc.php');
  include ('./includes/header.html');

    //require (MYSQL);
    //$r = mysqli_query ($dbc, "CALL select_sale_items(false)");

    if ($display_left_panel) include('./views/dsc-left.html');
    include('./views/middle.html');

  include ('./includes/footer.html');
?>
