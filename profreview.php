<?php 
		session_start();
		$song_id = null;
		$stars = null;
		$userID = $_SESSION["userID"]; 
	if(isset($_POST['submit'])) 
	{
		$song_id = $_POST['sid']; 
		$stars = $_POST["stars"];
	}
	
	$servername = "localhost";
	$serverusername = "root";
	$password = "";
	$dbname = "music library";

// Create connection
$conn = new mysqli($servername, $serverusername, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO professionalreview VALUES ('$song_id', '$stars','$userID' )" ; 


if ($conn->query($sql) === TRUE) {
    echo "New Professinal Review Made. Redirecting to the main page.";
}
else
{echo "Error: " . $sql . "<br>" . $conn->error;}


header('Refresh: 5;url=main.php');

?>

<!-- 
Error: INSERT INTO professionalreview VALUES ('', '','10001' )
Incorrect integer value: '' for column 'songID' at row 1
->