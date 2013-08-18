<?php
session_start();
$_SESSION['StartTime'] = date('r');
echo $_SESSION['StartTime'];
echo $_SESSION['id'];
?>
