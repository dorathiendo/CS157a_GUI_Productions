<?php
session_start();
$servername = "localhost";
	$serverusername = "root";
	$password = "";
	$dbname = "music library";
 // Create connection
$songIDs = $_POST['songID1'];
$review2 = $_POST['review1'];
$conn = new mysqli($servername, $serverusername, $password, $dbname);

$conn->query("DELIMITER // CREATE PROCEDURE addReview(IN songID INT, IN userID INT, IN Review VARCHAR(255))BEGIN INSERT INTO userreview VALUES(songID,userID,Review); END // DELIMITER ;");

$conn->query('CALL addReview('.$songIDs.','.$_SESSION['userID'].',"'.$review2.'")');



?>