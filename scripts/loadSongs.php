<?php
session_start();
include("../assets/setup/config.php");

$query = "select * from song;";
$results = mysqli_query($db, $query) or die("f");
$data = "";

if(!isset($_POST['songName'])) {
	while($row = mysqli_fetch_assoc($results)) {
		$data = $data . 
			"<div id='songcontainer' onclick=\"changeSong('songs/{$row['UploaderName']}-{$row['SongID']}')\" >" .
				"<div id='songname'>" .
					"<p> {$row['ArtistName']} - {$row['SongName']} </p>" .
				"</div>" .
				"<!--div id='like'><img src='assets/images/heart.png'></img></div-->" .
			"</div>" .
			"<br>";
	}
} else {
	while($row = mysqli_fetch_assoc($results)) {
		if(strcmp($row['SongName'], $_POST['songName']) == 0) {
			$data = $data . 
				"<div id='songcontainer'>".
					"<div id='songname'>" .
						"<a onclick=\"changeSong('songs/{$row['UploaderName']}-{$row['SongID']}')\" " .
						"href='#'> {$row['ArtistName']} - {$row['SongName']}" .	
						"</a>" .
					"</div>" .
				"</div>" .
				"<br>";
		}
	}
}
echo $data;
