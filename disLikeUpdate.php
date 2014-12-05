<?php

$servername = "localhost";
	$serverusername = "root";
	$password = "";
	$dbname = "music library";
 // Create connection
$disLikeIDs = $_POST['disLikeID'];
$conn = new mysqli($servername, $serverusername, $password, $dbname);
$sql ="UPDATE Likes SET noOfDislikes = noOfDislikes+1 WHERE songID = '".$disLikeIDs."'";
$conn->query($sql);



?>