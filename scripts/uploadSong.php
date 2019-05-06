<!DOCTYPE html>
<html>
<head>
   <!-- HTML meta refresh URL redirection -->
   <meta http-equiv="refresh"
   content="0; url=../index.php">
</head>



<?php
session_start();
include("../assets/setup/config.php");
error_reporting(E_ALL);
ini_set('display_errors',1);

$target_dir = __DIR__ . "/../songs/";

$name = htmlspecialchars($_FILES["fileToUpload"]["name"]);

/* file type for checking later */
$fileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));

$filehash = hash('ripemd160', $name . $_SESSION['username']);
//$filehash = "123";

$target_file = $target_dir . $_SESSION['username'] . "-" . basename($filehash);

$uploadOk = 1;


/* if they never submitted anything */
if(!isset($_POST["submit"])) {
	exit;
}

/* if it exists */
if (file_exists("../songs/" . $target_file)) {
	echo "Sorry, file already exists.";
	exit;
}

/* check file size */
if ($_FILES["fileToUpload"]["size"] > 50000000) {
	echo "Sorry, your file is too large.";
	exit;
}

/* restrict file types */
if($fileType != "mp3" && $fileType != "wav" && $fileType != "m4a") {
	echo "Sorry, only mp3 & wav";
	exit;
}

$query = "SELECT ArtistID FROM artist WHERE Username='{$_SESSION['username']}';";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$id = htmlspecialchars($row['ArtistID']);
$artist = mysqli_real_escape_string($db, htmlspecialchars($_POST['artist']));
$title= mysqli_real_escape_string($db, htmlspecialchars($_POST['title']));

$query = "insert into song (SongID, ArtistID, SongName, ArtistName, FilePath, UploaderName)
			VALUES('$filehash', '$id', '$title', '$artist', '$target_file', '{$_SESSION['username']}');";

mysqli_query($db, $query) or die(mysqli_error($db));

/* upload */
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
	echo "error<br>";
	echo "errorno: " . $_FILES['fileToUpload']['error'] . "<br>";
	echo "target: " . $target_file . "<br>";
	exit;
}
?>

<body>
</body>
</html>
