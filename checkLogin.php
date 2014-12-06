<?php
	session_start();
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
		$username = $_POST['username'];
		$password = $_POST['password']; 	

$sql = "SELECT * FROM user WHERE Username = '$username' AND Password='$password' ";
	
$result = $conn->query($sql);
$row = $result->fetch_assoc(); 

$sessionUserID = $row["userID"];

if($row["Username"] == $username && $row["Password"] == $password)
{
// Register $username, $password as session variables and redirect to file "main.php" 

	$_SESSION["userid"] = $row["userID"];
	$_SESSION["username"] = $row["Username"];
	$_SESSION['pass']=$password; 

header("location:main.php");
}
else 
{

echo "<font color='red'>Wrong Username or Password</font>";
echo "<script>setTimeout(\"location.href = 'index.php';\",1000);</script>";

}
?>