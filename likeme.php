<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Music Library</title>

<style> 
body{
		background-image:url(images/background.jpg)	
	}
h1	{
		font-size:80px;
		color:#BDBDBD;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:0%;
	}
#login {	
		background-color:#212121;
		width:40%;
		height:35%;
		position:absolute;
		margin: auto; 
		overflow: auto;
		top: 0; left: 0; bottom: 0; right: 0;
		z-index:1002px;
		border-radius:30px;
		border: 2px solid #FAFAFA;	
	   }
#table {	
		background-color:#212121;
		width:80%;
		height:80%;
		position:absolute;
		margin: auto; 
		overflow: auto;
		top: 0; left: 0; bottom: 0; right: 0;
	   }
#search{
		background-color:#212121;
		color: #FAFAFA;
		font-size:24px;	
		border-radius:10px;
	   }
#unibutton 
	   {
		   background-color:#212121;
		   color:#FAFAFA; 
		   border-radius:5px;	
		   border: 2px solid #FAFAFA;	
		   font-size:24px	
	   }
#unibutton:hover
	   {
		   background-color:#1A237E;
		   border: 1px solid #FAFAFA;	
	   
	   }
table {
		width:90%;
		background-color:#FAFAFA;
	  }
th    {
		width:10%;
		font-size:24px;
	   }
td 	   {
		font-size:24px;
		}
		
#settings{
float:right;
}
		
#account {
	text-decoration: none;
	color: white;
}

#logoutButton
{
width: 150px;
margin-top:-100px;

</style>
</head>
<body>
 <?php 
 
 	$userID = $_SESSION["userID"]; 
	$searchby = null;
		
	if(isset($_POST['submit'])) 
	{
		$searchby = $_POST['submit']; 
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

$sql = "SELECT l1.userID,l2.userID,song.Title as title from library as l1, library as l2, song Where l1.userID = $userID and l1.userID <> l2.userID and l1.songID = l2.songID and l1.songID = song.songID";	
 	
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	echo "<table align='center'>
	 			<tr>
					<th>UserID</th>
					<th>Title</th>
				</tr>";
    while($row = $result->fetch_assoc())
	 {
     	echo "<tr align='center'> 
		  <td>". $row['userID'] ."</td>
		  <td>". $row['title'] ."</td>
	  </tr>";
	 }
	
}
else
{echo "Error: " . $sql . "<br>" . $conn->error;} 
 ?>
<a id="account" href="main.php">Go Back</a>
</body>
</html>
