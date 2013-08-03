<?php
  require ('./includes/index.inc.php');
  require ('./includes/cart.inc.php');
 
  include ('./views/header.html');
    require ('./includes/left.inc.php');
    
      require(DBC);
      $prds = mysqli_query ($dbc, "CALL ls_prd()");
      //mysqli_next_result($dbc);

      if (isset ($_GET['id'], $_GET['action']) && ($_GET['action'] == 'view') )
      {
        require(DBC);
        $q = 'CALL get_prd('.$_GET['id'].')';
        $tmp = mysqli_query ($dbc, $q);
		  while ($row = mysqli_fetch_array($tmp, MYSQLI_ASSOC)) 
  	     {
  	     	 $prd = $row;
  	     }
        //mysqli_next_result($dbc);
      }
      
      include ('./views/middle.html');
      
    require ('./includes/right.inc.php');
  include ('./views/footer.html');
?>
