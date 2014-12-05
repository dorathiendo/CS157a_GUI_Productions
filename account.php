<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<	html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Music Library</title>
		<style> 
		body{
				background-image:url(images/background.jpg)	
			}
		#center{
			margin-left: auto;
			margin-right: auto;
			background-color: white;
			width: 400px;
			height: 300px;
			margin-top: 50px;
			text-align: center;
			padding: 50px;
			border-radius: 25px;
			border: 5px solid;
			border-color: grey;
		}
		</style>
	</head>
	<body>
		<div id="center">
			<h1>Account Settings: </h1>
			<br>
			Username: 
			<?php
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
				
				if(isset($_SESSION['uname'])){
					echo $_SESSION["uname"];
				}
				
				//change 'Dora' to session username
				$sql = "SELECT * FROM User WHERE Username = 'Dora'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()){
					echo $row["Username"];
				}
			
				echo "<br><br>
				Change password: <br>
				<form action=\"account.php\" method=\"post\">
				Enter new password: <input id=\"input\" type=\"password\" name=\"password\" />
				<input type=\"submit\" name=\"submit\" value=\"Submit\">
				</form>";
				
				$newPassword = null;
				
				if(isset($_POST['password']) ) 
				{
					$newPassword = $_POST['password']; 
				}
				
				//change 'Dora' to session username
				$change_password = "UPDATE User SET Password = '$newPassword' WHERE Username = 'Dora';";
				$result = $conn->query($change_password);
			?>
			<br>
			<a href="main.php">Go Back</a>
			<br>
			<a href="backup.php">Export my library to excel</a>
		</div>
	</body>
</html>