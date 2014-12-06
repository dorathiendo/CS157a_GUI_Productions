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
}
#mostliked{
	color: white;
	font-size: 40px;
	text-align: center;
}
</style>
</head>

<body>
<?php 

	$deltesong = null;
		
	if(isset($_POST['sid'])) 
	{
		$deletesong = $_POST['sid']; 
		echo $deletesong;
	}
	$deleteSong_query = "DELETE FROM library WHERE songID = $deletesong";
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


if ($conn->query($deleteSong_query) === TRUE) {
    //echo "New record created successfully";
	header("location:library.php");
}
else
{echo "Error: " . $addSong_query . "<br>" . $conn->error;}


?>
</body>
</html>