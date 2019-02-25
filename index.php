<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <form action="/register.html">
      <input type="submit2" value="Upload" />
  </form>
  <br>
  <form action="/register.html">
      <input type="submit2" value="Playlists" />
  </form>
  <br>
  <form action="/register.html">
      <input type="submit2" value="Settings" />
  </form>
  </div>

  
</div>
</body>

<audio controls>
<source src="test.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

</html>
