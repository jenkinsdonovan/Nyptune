<?php
session_start();
$logged = (isset($_SESSION['logged']))?$_SESSION['logged']:''; 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/style.css">
	<link rel="shortcut icon" type="image/ico" href="assets/images/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title>Nyptune Web Player | Landing</title>
</head>

<body>
<div class="navbar">
	<a href="index.html">Nyptune</a>
	<div class="logincontainer"><?php
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE) {
			echo '<form action="login.php" method="post" class="loginform">
				 <input class="frm" type="text" name="username" placeholder="Username" required>
				 <input class="frm" type="password" name="password" placeholder="Password" required>
				 <input class="frm" type="submit" name="Login" value="Login">
				 <input class="frm" type="submit" name="Register" value="Register"></form>';
		} else {
			echo '<form action="logout.php" method="post">
				 <input type="submit" value="Logout"/></form>';
		}
	?></div>
  <input type="text2" id="search" class="frm" name="search" placeholder="Search for artists, songs, podcasts..."> 
</div>

<div class="main">
	<div class="sidenav">
		<button onclick="home();">Home</button>
		<button onclick="upload();">Upload</button>
		<!--button onclick="playlist();">Playlists</button>
		<button onclick="settings();">Settings</button-->
	</div>

	<div class="maincontainer" id="maincontainer"/>

	<script type="text/javascript"> 
		/* to be loaded when the page loads */
		$(document).ready(function() {
			home();
		});

		function home() {
			$.ajax({
				url:	"scripts/loadSongs.php",
				type:	"POST",
				success: function(data) {
					$(".maincontainer").html(data);
				}
			});
		}
		function upload() {
			var uploadbutton = "";
			var logged = "<?php echo $logged;?>" ;
			if(logged === "1") {
				uploadbutton = `
					<div class="bc">
  					<h1>Upload an audio file</h1>
					<form action='scripts/uploadSong.php' method='POST' enctype='multipart/form-data'>
   					<input type="text" name="title" placeholder="Title" required>
   					<input type="text" name="artist" placeholder="Artist" required>
       				<select>
          			<option value="" disabled="disabled" selected="selected">Genre</option>
          		 	<option value="1">Electronic</option>
          		 	<option value="2">Rock</option>
          		 	<option value="1">Heavy Metal</option>
          		 	<option value="2">Jazz</option>
          		 	<option value="1">Ambient</option>
          		 	<option value="2">Soundtrack</option>
       				</select>
   					<br>
					<input type='file' name='fileToUpload' id='fileToUpload'">
					<input type='submit' value='Upload Song' name='submit'>
					</div> `;
			} else {
				uploadbutton = "Please log in" + logged;
			}
			$(".maincontainer").html(uploadbutton);
		}
		function playlist() {
			/*
			$.ajax({
				url:	"scripts/loadPlaylists.php",
				type:	"POST",
				success: function(data) {
					$(".maincontainer").html(data);
				}
			});
			*/
			$(".maincontainer").html("to be implemented");
		}
		function settings() {
			/*
			$.ajax({
				url:	"scripts/loadSettings.php",
				type:	"POST",
				success: function(data) {
					$(".maincontainer").html(data);
				}
			});
			*/
			$(".maincontainer").html("to be implemented");
		}
		function changeSong(filename) {
			var audio = document.getElementById('audio');
			var source = document.getElementById('songsource');
			source.src = filename;
			audio.load();
			audio.play();
		}

		/*************************** LISTENER FOR SEARCH BAR ************/
		var input = document.getElementById("search");
		input.addEventListener("keyup", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				// getting user input
				var userinp = document.getElementById("search").value;
				//userinp = userinp.toLowerCase(userinp);
				// getting all songs
				var phpret = "hi";
				$.ajax({
					type: "GET",
					url: "scripts/getSongs.php",
					async: false,
					success: function(data) {
						//phpret = Array.from(data);
						phpret = data.split(";,;");
					}
				});
				var test = "";
				var ret = "";
				var i;
				for(i = 0; i < phpret.length; i++) {
					test = matching(userinp, phpret[i]);
					if(test != 0) {
						$.ajax({
							type: "POST",
							data: {songName: phpret[i]},
							url: "scripts/loadSongs.php",
							async: false,
							success: function(data) {
								ret += data;
							}
						});
					}
				}

				$(".maincontainer").html(ret);
			}
		});

		function matching(inputstring, querystring) {
			//var cleanis = clean(inputstring); //clean removes all and's and the's, to be implemented outside
			cleanis = inputstring;
			//var cleanqs = clean(querystring);
			cleanqs = querystring;
			if (cleanis.length == 0) {
				return 0;
			}
			var maxlength = Math.max(0, Math.max(cleanis.length, cleanqs.length) / 2 - 1);
			
			var ismatch = [];
			for (var i = 0; i < cleanis.length; i += 1) {
			  	ismatch.push(false);
			}

			var qsmatch = [];
			for (var i = 0; i < cleanqs.length; i += 1) {
			  	qsmatch.push(false);
			}
			
			var matchnum = 0;
			for (var i = 0; i < cleanis.length; i += 1) {
				var minidx = Math.max(i - maxlength, 0);
				var maxidx = Math.min(i + maxlength + 1, cleanqs.length);

				if (maxidx < minidx) {
					break;
				}

				for (var j = minidx; j < maxidx; j += 1) {
					if (/*!iqmatch[j] && */cleanis[i] == cleanqs[j]) {
						//iqmatch[j] = true;
						ismatch[i] = true;
						matchnum += 1;
						break;
					}
				}
			}

			if (matchnum == 0) {
				return 0;
			}

			var ispos = [];
			var qspos = [];
			for (var i = 0; i < matchnum; i += 1) {
			  	ismatch.push(0);
			  	qsmatch.push(0);
			}

			var i, j;
			for (i = 0, j = 0; i < cleanis.length; i += 1) {
				if (ismatch[i] == true) {
					ispos[j] = i;
					j += 1; 
				}
			}

			for (i = 0, j = 0; i < cleanqs.length; i += 1) {
				if (qsmatch[i] == true) {
					qspos[j] = i;
					j += 1;
				}
			}

			var htrans = 0;
			for (var i = 0; i < matchnum; i += 1) {
				if (cleanis[ispos[i]] != cleanqs[qspos[i]]) {
					htrans += 1;
				}
			}
			
			//return matchnum;
			return 
			((1/2) * matchnum / cleanis.length) + 
			((1/2) * matchnum / cleanqs.length) + 
			((1/2) * (matchnum - htrans / 2) / matchnum);	
			//one third value is weight and can be adjusted at will
		}

		document.body.onkeyup = function(e){
    		if(e.keyCode == 32){
				var audio = document.getElementById('audio');
				if(!$(".frm").is(':focus')) {
					if(audio.paused)
						audio.play();
					else
						audio.pause();
				}
				
    		}
		}



	</script>
            <script>
                function myFunction() {
                      var x = document.getElementById("myFile");
                      x.disabled = true;
                  }
              </script>
</div>
</body>

<audio id="audio" controls>
<source id="songsource" src="test.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

</html>
