<?
  require ('./models/base.php');
  
  include ('./views/header.html');
    require ('./models/left.php');
      include ('./views/middle.html');
    require ('./models/right.php');
  include ('./views/footer.html');
?>
