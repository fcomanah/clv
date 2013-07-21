<?php
  require ('./includes/config.inc.php');
  require (MYSQL);

    $page_title = 'usr';
  
    $display_left_panel = false;
    $left_panel_href = '';
    $left_panel_data_icon = '';
    $left_panel_name = '';

    $display_right_panel = false;
    $right_panel_href = '';
    $right_panel_data_icon = '';
    $right_panel_name = '';

  require ('./includes/hf_functions.inc.php');
  include ('./includes/header.html');

    require ('./includes/form_functions.inc.php');
    require ('./includes/usr.inc.php');
    include ('./views/usr-middle.html');

  include ('./includes/footer.html');

?>
