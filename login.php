<?php
	session_start();
	$_SESSION['logged'] = TRUE;
	//$_SESSION['username'] = $_POST['username']; //htmlspecialchars this
	$_SESSION['username'] = "ayy";
	header('location: index.php');
	die();
?>
