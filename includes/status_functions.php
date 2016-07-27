<?php
    include("auth_functions.php");

	function create_status($link,$row){
		$result=mysqli_query($link,"INSERT INTO `status` (`nome`, `descricao`) VALUES ('$row[1]', '$row[2]');");
	}

	function read_status($link){
		$result=mysqli_query($link,"SELECT * FROM `status` ORDER BY `nome`");
        $rows = array();
        while (	$row=mysqli_fetch_row($result) ){
            array_push($rows, $row);
        }
		return $rows;
	}

	function update_status($link,$row){
		$result=mysqli_query($link,"UPDATE `status` SET `codigo` = '$row[0]', `nome` = '$row[1]', `descricao` = '$row[2]' WHERE `codigo` = '$row[0]';");
	}

	function delete_status($link,$pid){
		$result=mysqli_query($link,"DELETE FROM `status` WHERE `codigo`='$pid'");
	}
?>
