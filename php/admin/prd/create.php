<?
  require ('./models/create/base.php');

  redirect_invalid_user('user_admin', '../');
  
  include ('./views/header.html');
    require ('./models/left.php');
      include ('./views/create-middle.html');
    require ('./models/right.php');
  include ('./views/footer.html');
  
?>
