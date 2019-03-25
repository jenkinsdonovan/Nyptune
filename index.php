<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Nyptune Web Player | Landing</title>
</head>



<body>

<div class="navbar">
  <a href="index.html">Nyptune</a>
  <div class="container">
    <div class="col">
		<?php
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE) {
		echo '
        <form action="login.php" method="post">
        	<input type="text" name="username" placeholder="Username" required>
        	<input type="password" name="password" placeholder="Password" required>
        	<input type="submit" value="Login">
            <input type="submit" value="Sign Up" />
        </form>
		';
		} else {
		echo '
		<form action="logout.php" method="post">
			<input type="submit" value="Logout"/>
		</form>
		';
		}
		?>
      </div>
    </div>
  <input type="text2" name="search" placeholder="Search for artists, songs, podcasts..."> 
</div>
</div>


<div class="main">


  <div class="sidenav">
  <button onclick="home();">Home</button>
  <button onclick="upload();">Upload</button>
  <button onclick="playlist();">Playlists</button>
  <button onclick="settings();">Settings</button>
  </div>

  <div class="maincontainer">

  </div>

  
</div>
</body>

<audio controls>
<source src="test.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

<script> 
	/* to be loaded when the page loads */
	$(document).ready(function(){
		$(".maincontainer").html("home");
	});

	/* button functions. Will eventually use ajax to call php scripts */
	function home() {
		$(".maincontainer").html("home");
	}
	function upload() {
		$(".maincontainer").html("upload");
	}
	function playlist() {
		$(".maincontainer").html("playlist");
	}
	function settings() {
		$(".maincontainer").html("settings");
	}
</script>

</html>
