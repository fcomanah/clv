<?php
	$link=mysqli_connect("localhost","clvu","clvp") or die("clv is not available, please try again later: 1");	
	mysqli_select_db($link, "clv") or die("clv is not available, please try again later: 2");
	session_start();
?>
