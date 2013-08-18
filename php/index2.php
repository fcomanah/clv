<?php
  require ('./models/base.php');
  require ('./models/cart.php');

function get_prd_from_ctg($ctg_id)
{
	 require(DBC);
    $q = mysqli_query ($dbc, "CALL ls_prd_from_ctg('$ctg_id')");
      
    $prds=array();
      
    if (mysqli_num_rows($q) > 0) 
    {
	   while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)) 
  	   {
        array_push($prds,$row);
      }
    }
    return $prds;
}

function get_ctg_flh($ctg_id)
{
	 require(DBC);
    $q = mysqli_query ($dbc, "CALL ls_ctg_flh('$ctg_id')");
      
    $ctgs=array();
      
    if (mysqli_num_rows($q) > 0) 
    {
	   while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)) 
  	   {
        array_push($ctgs,$row['id_']);
      }
    }
    return $ctgs;
}


  if (isset($_GET['action']) && ($_GET['action'] == 'pay') && !empty($car)) $page_title = 'Finalizando Compra';
 
  include ('./views/header.html');
     
  if(isset($_GET['id'], $_GET['action']) && ($_GET['action'] == 'nav'))
  {
    require(DBC);
 	
    $ctg_id = $_GET['id'];
    if($ctg_id>1)
  	{
      $nav = array();

  	  $tmp = mysqli_query ($dbc, "CALL ls_ctg_pai('$ctg_id')");
      $tmp = mysqli_fetch_array($tmp, MYSQLI_ASSOC);
      mysqli_next_result($dbc);
        
      if($tmp) 
      {
         array_unshift($nav,$tmp);
         $ctg_id = $tmp['id_'];
      }
        
      $contador=1;
      while($ctg_id>1 && $contador<4)
      {           
         $tmp = mysqli_query ($dbc, "CALL ls_ctg_pai('$ctg_id')");
         $tmp = mysqli_fetch_array($tmp, MYSQLI_ASSOC);
         mysqli_next_result($dbc);
        
         if($tmp) 
         {
           array_unshift($nav,$tmp);
           $ctg_id = $tmp['id_'];
         }
         ++$contador;
      }
    }

    $ctg_id = $_GET['id'];
    $ctg_atual = mysqli_query ($dbc, "CALL get_ctg('$ctg_id')");
    $ctg_atual = mysqli_fetch_array($ctg_atual, MYSQLI_ASSOC);

  }
    
  if(!empty($ctg_atual))
  {
    $id = $ctg_id;
    $prds = array();
    $flhs = array();
    $tmp_prds = array();
    $tmp_flhs = array();
    do
    {
      $tmp_prds = get_prd_from_ctg($id);
      if(!empty($tmp_prds)) $prds = array_merge($prds, $tmp_prds);
      
      $tmp_flhs = get_ctg_flh($id);
      if(!empty($tmp_flhs)) $flhs = array_merge($flhs, $tmp_flhs);
      
      $id = array_shift($flhs);
      //echo $id." ";
      //print_r($flhs);
      
    }while(!empty($id));
    //print_r($prds);
    //exit();

    require ('./models/nav-left.php');      
    include ('./views/nav-middle.html');
  }
  else
  {
    require(DBC);
    $prds = mysqli_query ($dbc, "CALL ls_prd()");

    if (isset ($_GET['id'], $_GET['action']) && ($_GET['action'] == 'view') )
    {
      require(DBC);
      $q = 'CALL get_prd('.$_GET['id'].')';
      $tmp = mysqli_query ($dbc, $q);
      while ($row = mysqli_fetch_array($tmp, MYSQLI_ASSOC)) 
      {
        $prd = $row;
      }

      $ctg_id=$prd['id_ctg'];
      require(DBC);
      $ctg_atual = mysqli_query ($dbc, "CALL get_ctg('$ctg_id')");
      $ctg_atual = mysqli_fetch_array($ctg_atual, MYSQLI_ASSOC);
    }

    require ('./models/left.php');
      
    if (isset($_GET['action']) && ($_GET['action'] == 'pay') && !empty($car))
    {
      require ('./models/functions/form.php');
    
      $valid = false;
      $shipping_errors = array();
    
      if($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        require ('./models/checkout/validation.php');
      
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
      include ('./models/bcash/consulta.php');
      include ('./views/transacao-middle.html');
      echo '</div>';
    }
    else
    {


      include ('./views/nav-middle.html');
    }
  }
      
  require ('./models/right.php');
  include ('./views/footer.html');
?>
