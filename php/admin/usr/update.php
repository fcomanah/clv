<?
  require ('./includes/update-model.inc.php');

  redirect_invalid_user('user_admin');
  
  include ('./views/header.html');
    require ('./includes/update-left.inc.php');
      include ('./views/update-middle.html');
    require ('./includes/right.inc.php');
  include ('./views/footer.html');
  
?>
