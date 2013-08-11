<?
  require ('./models/update/base.php');

  redirect_invalid_user('user_admin');
  
  include ('./views/header.html');
    require ('./models/update/left.php');
      include ('./views/update-middle.html');
    require ('./models/right.php');
  include ('./views/footer.html');
  
?>
