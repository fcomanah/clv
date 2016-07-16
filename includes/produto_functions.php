<?php
	function create_product($link,$row){
		$result=mysqli_query($link,"INSERT INTO `produto` (`nome`, `descricao`, `preco`, `imagem`, `quantidadeestoque`) VALUES ('$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]');");
	}

	function get_all_products($link){
		$result=mysqli_query($link,"SELECT * FROM `produto` ORDER BY `nome`");
        $rows = array();
        while (	$row=mysqli_fetch_row($result) ){
            array_push($rows, $row);
        }
		return $rows;
	}

	function remove_product($link,$pid){
		$result=mysqli_query($link,"DELETE FROM `produto` WHERE `sku`='$pid'");
	}

	function update_product($link,$row){
		$result=mysqli_query($link,"UPDATE `produto` SET `sku` = '$row[0]', `nome` = '$row[1]', `descricao` = '$row[2]', `preco` = '$row[3]', `imagem` = '$row[4]', `quantidadeestoque`='$row[5]'  WHERE `sku` = '$row[0]';");
	}

	function set_image_product($link,$row){
		$result=mysqli_query($link,"UPDATE `produto` SET `sku` = '$row[0]', `imagem` = '$row[4]' WHERE `sku` = '$row[0]';");
	}

	function get_name_product($link,$pid){
		$result=mysqli_query($link,"SELECT `nome` FROM `produto` WHERE `sku`='$pid'");
    $row=mysqli_fetch_row($result);
    return $row['0'];
	}
	function get_image_product($link,$pid){
		$result=mysqli_query($link,"SELECT `imagem` FROM `produto` WHERE `sku`='$pid'");
    $row=mysqli_fetch_row($result);
    return $row['0'];
	}
?>
