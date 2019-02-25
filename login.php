<?php
	session_start();
	$_SESSION['logged'] = TRUE;
	header('location: index.php');
	die();
?>
