<?php
  require ('./includes/index.inc.php');
  require ('./includes/cart.inc.php');
  if (isset($_GET['action']) && ($_GET['action'] == 'pay') && !empty($car)) $page_title = 'Finalizando Compra';
 
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
      
      
  if (isset($_GET['action']) && ($_GET['action'] == 'pay') && !empty($car))
  {
    require ('./includes/form_functions.inc.php');
    
    $valid = false;
    $shipping_errors = array();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      require ('./includes/check-validation.inc.php');
      
      if(empty($shipping_errors))
      {
        $valid = true;
      }
    }
    
    include ('./views/check-middle.html');

  }
  elseif(isset($_GET['id_transacao']) )
  {
  	 echo '    <div data-role="content" role="main">';
    include ('./includes/bcash_consulta.php');
    include ('./views/transacao-middle.html');
    echo '</div>';
  }
  else 
  {
    include ('./views/middle.html');
  }
  
  
      
    require ('./includes/right.inc.php');
  include ('./views/footer.html');
?>
