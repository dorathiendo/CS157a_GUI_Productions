<?php

$servername = "localhost";
	$serverusername = "root";
	$password = "";
	$dbname = "music library";
 // Create connection
//$likeIDs = $_POST['likeID'];
$review2 = $_POST['review1'];
$conn = new mysqli($servername, $serverusername, $password, $dbname);

//$conn->query("CREATE PROCEDURE addReview(IN songID INT, IN userID INT, IN Review VARCHAR(100)) BEGIN INSERT INTO userreview VALUES(songID,userID,Review); END;");

//$conn->query("CALL addReview(".songIDs."".$_SESSION['userID']."".$_POST["comment"].")")
$conn->query("CALL addReview(101,10001,greatgreatgreat)");



?>