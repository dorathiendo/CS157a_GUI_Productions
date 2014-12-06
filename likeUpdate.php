<?php
session_start();
$servername = "localhost";
	$serverusername = "root";
	$password = "";
	$dbname = "music library";
 // Create connection
$likeIDs = $_POST['likeID'];
$conn = new mysqli($servername, $serverusername, $password, $dbname);
$sql ="UPDATE Likes SET noOfLikes = noOfLikes+1 WHERE songID = '".$likeIDs."'";
$conn->query($sql);



?>