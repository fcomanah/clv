<?php
	include("includes/db.php");
	include("includes/carrinho_functions.php");
  init_sessao($link);

	if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		addtocart($link,$pid,1);
		header("location:carrinho.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catálogo</title>
</head>
<body>
<form name="form1">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div align="right">
    <a style="text-decoration: none" href="catalogo.php">Catálogo</a>
    <a style="text-decoration: none" href="carrinho.php">Carrinho</a>
    <a style="text-decoration: none" href="pagamento.php">Pagamento</a>
</div>
<div align="center">
	<h1 align="center">Catálogo</h1>
	<table border="0" cellpadding="2px" width="600px">
		<?php
			$result=get_all_products($link);
			while($row=mysqli_fetch_row($result)){
		?>
    	<tr>
        	<td><img src="<?php echo 'images/'.$row[4]?>" /></td>
            <td>
                <b><?php  echo $row[1]?></b><br/>
                <?php  echo $row[2]?><br />
                Preço:<big style="color:green"> R$ <?php  echo number_format($row[3], 2, '.', ' ')?></big><br /><br />
                <a style="text-decoration: none" href="catalogo.php?command=add&productid=<?php echo $row[0]?>">
                <input type="button" value="Adicionar ao Carrinho"/></a>
			</td>
		</tr>
        <tr><td colspan="2"><hr size="1" /></td>
        <?php } ?>
    </table>
</div>
</body>
</html>
