<?php
include('config.php');
error_reporting(E_ALL);
$query =	"CREATE TABLE IF NOT EXISTS `nyptune`.`artist` (".
  			"`ArtistID` INT(11) NOT NULL AUTO_INCREMENT,".
  			"`ArtistName` VARCHAR(45) NOT NULL,".
  			"`CreationDate` DATE NULL DEFAULT NULL,".
  			"`Password` VARCHAR(45) NOT NULL,".
  			"`Username` VARCHAR(45) NOT NULL,".
  			"PRIMARY KEY (`ArtistID`),".
  			"UNIQUE INDEX `ArtistID_UNIQUE` (`ArtistID` ASC),".
  			"UNIQUE INDEX `Username_UNIQUE` (`Username` ASC))".
			"DEFAULT CHARACTER SET = utf8;";
mysqli_query($db, $query) or die("f query 2");
echo "successfully created artist table\n";


$query =	"CREATE TABLE IF NOT EXISTS `nyptune`.`genres` (".
  			"`Genre` INT(11) NOT NULL,".
  			"PRIMARY KEY (`Genre`))".
			"DEFAULT CHARACTER SET = utf8;";
mysqli_query($db, $query) or die("f query 3");
echo "successfully created genre table\n";


$query =	"CREATE TABLE IF NOT EXISTS `nyptune`.`song` (".
  			"`SongID` CHAR(64) NOT NULL,".
  			"`ArtistID` INT(11) NOT NULL,".
  			"`SongName` VARCHAR(45) NOT NULL,".
  			"`ArtistName` VARCHAR(45) NOT NULL,".
  			"`UploaderName` VARCHAR(45) NOT NULL,".
  			"`AlbumName` VARCHAR(45) NULL DEFAULT NULL,".
  			"`SongLength` FLOAT NULL DEFAULT NULL,".
  			"`Date` DATE NULL DEFAULT NULL,".
  			"`Likes` INT(11) NULL DEFAULT NULL,".
  			"`Dislikes` INT(11) NULL DEFAULT NULL,".
  			"`ViewCount` INT(11) NULL DEFAULT NULL,".
  			"`FilePath` VARCHAR(100) NOT NULL,".
  			"PRIMARY KEY (`SongID`),".
  			"UNIQUE INDEX `SongID_UNIQUE` (`SongID` ASC),".
  			"UNIQUE INDEX `FilePath_UNIQUE` (`FilePath` ASC),".
  			"INDEX `ArtistID_idx` (`ArtistID` ASC),".
  			"CONSTRAINT `ArtistID`".
    		"FOREIGN KEY (`ArtistID`)".
    		"REFERENCES `nyptune`.`artist` (`ArtistID`))".
			"DEFAULT CHARACTER SET = utf8;";
mysqli_query($db, $query) or die("f query 4");
echo "successfully created song table\n";


$query =	"CREATE TABLE IF NOT EXISTS `nyptune`.`genrer_relator` (".
  			"`SongID` INT(11) NOT NULL,".
  			"`Genre` VARCHAR(45) NOT NULL,".
  			"PRIMARY KEY (`SongID`, `Genre`),".
  			"CONSTRAINT `Genre`".
    		"FOREIGN KEY (`SongID`)".
    		"REFERENCES `mydb`.`genres` (`Genre`),".
 			" CONSTRAINT `SongID`".
    		"FOREIGN KEY (`SongID`)".
    		"REFERENCES `mydb`.`song` (`SongID`))".
			"DEFAULT CHARACTER SET = utf8;".
mysqli_query($db, $query) or die("f query 5");
echo "successfully created genre relator table\n";
