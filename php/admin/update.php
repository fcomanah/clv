<?
  require ('./includes/update-model.inc.php');

  redirect_invalid_user();
  
  include ('./views/header.html');
    require ('./includes/left.inc.php');
      include ('./views/update-middle.html');
    require ('./includes/right.inc.php');
  include ('./views/footer.html');
  
?>
