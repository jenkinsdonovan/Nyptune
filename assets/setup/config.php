<?php
/* user mysql info. TODO: make a new user that can only alter nyptune */
$host = "localhost";
$user = "root";
$password = "ilovecorgis";
$database = "nyptune";

/* connect to mysql */
$connection = new mysqli($host, $user, $password);
if($connection->connect_error) {
	die("f: $connection->connect_error");
}

/* create the nyptune db if it doesn't exist */
$query = "CREATE DATABASE IF NOT EXISTS $database;";
if($connection->query($query) != TRUE) {
	echo "query = $query\n";
	die("failed to create database");	
}

/* close the connection cause idk how to use the object */
$connection->close();

/* use $db instead */
$db = mysqli_connect($host, $user, $password) or die("f");
mysqli_select_db($db, $database) or die("f");
