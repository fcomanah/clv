<?php
  require ('./includes/config.inc.php');

    $page_title = 'index';
  
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
  
  require ('./includes/hf_functions.inc.php');
  include ('./includes/header.html');


    require (MYSQL);
    $ctgs = mysqli_query ($dbc, "CALL ls_ctg()");    
    mysqli_next_result($dbc);
    $prds = mysqli_query ($dbc, "CALL ls_prd()");
    mysqli_next_result($dbc);
    
    
    require ('./includes/car.inc.php');
    
        
    if ($display_left_panel) include('./views/left.html');
    include('./views/middle.html');
    if ($display_right_panel) include('./views/right.html');
    

  include ('./includes/footer.html');
?>
