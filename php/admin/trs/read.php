<?
  require ('./models/read/base.php');

  redirect_invalid_user('user_admin');
  
  include ('./views/header.html');
    require ('./models/read/left.php');
      include ('./views/read-middle.html');
    require ('./models/right.php');
  include ('./views/footer.html');
  
?>
