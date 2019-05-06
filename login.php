<?php
	session_start();
	include("assets/setup/config.php");

	$username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
	$password = md5(mysqli_real_escape_string($db, htmlspecialchars($_POST['password'])));

	if(isset($_POST['Login'])) {
		$query = "SELECT * FROM artist WHERE ArtistName='$username' AND Password='$password';";
		$result = mysqli_query($db, $query) or die(mysqli_error($db));
		$row = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 1) {
			$_SESSION['logged'] = TRUE;
			$_SESSION['username'] = $username; 
			header('location: index.php');
			exit;
		}
		$_SESSION['error'] = "Invalid username or password";
		header('location: index.php');
		die();
	}
	if(isset($_POST['Register'])) {

		$check_query = "SELECT * FROM artist WHERE Username='$username' LIMIT 1;";
		$result = mysqli_query($db, $check_query) or die("f");
		$user = mysqli_fetch_assoc($result);
		if($user) {
			$_SESSION['error'] = "Username exists";
			header('location: index.php');
			exit;
		}

		$query = "INSERT INTO artist (ArtistName, Password, Username) VALUES('$username', '$password', '$username');";
		mysqli_query($db, $query) or die(mysqli_error($db));

		$_SESSION['logged'] = TRUE;
		$_SESSION['username'] = $username; 
		header('location: index.php');
		die();
	}
?>
