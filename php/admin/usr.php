<?php
  require ('./includes/config.inc.php');
  require (MYSQL);

    $page_title = 'usr';
  
    $display_left_panel = true;
    $left_panel_href = 'usr';
    $left_panel_data_icon = 'flat-menu';
    $left_panel_name = 'Usuários';

    $display_right_panel = false;
    $right_panel_href = '';
    $right_panel_data_icon = '';
    $right_panel_name = '';

    require ('./includes/usr.inc.php');
       
    if(isset($uid))
    {   
      $qry = "CALL get_usr($uid)";
      $usr_info_mysql_object = mysqli_query ($dbc, $qry);
      mysqli_next_result($dbc);
      
      if (mysqli_num_rows($usr_info_mysql_object) > 0) 
      {
         $usr_info = mysqli_fetch_array($usr_info_mysql_object, MYSQLI_ASSOC);
      }
      
      if(isset($usr_info)) $page_title .= ' ' . $usr_info['nme'];
    }

  require ('./includes/hf_functions.inc.php');
  include ('./includes/header.html');

    $usrs = mysqli_query ($dbc, "CALL ls_usr()");
    if ($display_left_panel) include('./views/usr-left.html');   
      
    require ('./includes/form_functions.inc.php');    
    if(isset($uid))
    {
      include ('./includes/usr-update.php');
    }
    else 
    {      
      include ('./includes/usr-create.php');
      include ('./views/usr-create-middle.html');
    }    

  include ('./includes/footer.html');

?>
