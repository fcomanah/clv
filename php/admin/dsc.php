<?php
  require ('./includes/config.inc.php');
  require (MYSQL);

    $page_title = 'dsc';
  
    $display_left_panel = true;
    $left_panel_href = 'prd';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'Produtos';

    $display_right_panel = false;
    $right_panel_href = '';
    $right_panel_data_icon = '';
    $right_panel_name = '';

    require ('./includes/dsc.inc.php');
       
    if(isset($pid))
    {   
      $qry = "CALL get_prd($pid)";
      $prd_info_mysql_object = mysqli_query ($dbc, $qry);
      mysqli_next_result($dbc);
      
      if (mysqli_num_rows($prd_info_mysql_object) > 0) 
      {
         $prd_info = mysqli_fetch_array($prd_info_mysql_object, MYSQLI_ASSOC);
      }
      
      $qry = "CALL get_ctg($prd_info[id_ctg])";
      $prd_info_mysql_object = mysqli_query ($dbc, $qry);
      mysqli_next_result($dbc);
      if (mysqli_num_rows($prd_info_mysql_object) > 0) 
      {
         $prd_ctg = mysqli_fetch_array($prd_info_mysql_object, MYSQLI_ASSOC);
      }
      
      $page_title .= ' ' . $prd_info['nme'];
    }


  require ('./includes/hf_functions.inc.php');
  include ('./includes/header.html');

    $prds = mysqli_query ($dbc, "CALL ls_prd()");

    if ($display_left_panel) include('./views/dsc-left.html');    
    include('./views/dsc-middle.html');

  include ('./includes/footer.html');

?>
