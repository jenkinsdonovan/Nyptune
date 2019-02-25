<?php
	session_start();
	$_SESSION['logged'] = False;
	header('location: index.php');
	die();
?>
