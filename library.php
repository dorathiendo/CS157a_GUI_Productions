<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Music Library</title>

<style> 
body{
		background-image:url(images/background.jpg);
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
#link {
	text-decoration: none;
	color: white;
}
a:visited {
    text-decoration: none;
}
lib{
	color:white;
}
</style>
</head>

<body>
<a class="link" href="account.php">Account Settings</a>

<div align="center">
     <form action="main.php" method="post"> 
     	 <input name="submit" type="text" id="search"/>
        <input type="submit" id="unibutton" value="Search"/>
     </form> 
 </div> <br />	
<!--<div align="center"> 
 	<form id="search" action="main.php" method="post">
    Categories:
  		 	<input type="submit" name="submit" id="unibutton"  value="Pop"/>
  			<input type="submit" name="submit" id="unibutton"  value="Hip-Hop"/>
  			<input type="submit" name="submit" id="unibutton"  value="Alternative">
  			<input type="submit" name="submit" id="unibutton"  value="Country"/>
  			<input type="submit" name="submit" id="unibutton"  value="Indie"/>
  			<input type="submit" name="submit" id="unibutton"  value="Electronics"/>
            <input type="submit" name="submit" id="unibutton"  value="Club"/>
    </form>
</div>-->
<div align="center">
	<h1>My Library</h1>
</div>
<br /> 

 <?php
 	session_start();
	$song_id = "";
	if(isset($_POST['sid'])){
		$song_id = $_POST['sid'];
		$song_id = substr($song_id,0,3);
	}
<<<<<<< HEAD
	$userID = $_SESSION["userID"]; 
	$addSong_query = "INSERT INTO library VALUES ('$userID', '$song_id');";
=======
	
	$addSong_query = "INSERT INTO Library VALUES ('10003', '$song_id');"; //replace 10003 with session
>>>>>>> origin/master
	
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

if ($conn->query($addSong_query) === TRUE) {
    echo "New record created successfully";
}
else
{echo "Error: " . $addSong_query . "<br>" . $conn->error;}

$sql = "SELECT * FROM Library,Song,Likes WHERE Library.songID = Song.songID AND Library.songID = Likes.songID AND userID = '$userID'"; //replace 10003 with phpsession

if(isset($_POST['submit'])) {
		//echo "searchby is: ". $searchby;
		$sql = "SELECT * FROM song INNER JOIN Likes ON Song.songID = Likes.songID WHERE Title LIKE '%$searchby%' OR Artists LIKE '%$searchby%' OR Genre LIKE '%$searchby%' OR ReleaseDate LIKE '$%searchby%'";

	}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
     echo "<table align='center'>
	 			<tr>
					<th>Album Cover</th>
					<th>Title</th>
					<th>Artists</th>
					<th>Length</th>
					<th>Genre</th>
					<th>Release Date</th>
					<th>Likes</th>
					<th>Dislikes</th>
					<th> Remove </th> 
				</tr>";

	 
    while($row = $result->fetch_assoc())
	 {
	 $idOfSong=$row["songID"];
      echo "<tr align='center'> 
		  <td> <img width='150px' height='150px' src='" . $row["AlbumCover"]. " '/> </td> 
		  <td><a href = 'song.php?songID=".$idOfSong."'>" .$row["Title"]. " </a></td>
		  <td>" .$row["Artists"]."</td>
		  <td>".$row["Length"]." </td>
		  <td> ".$row["Genre"]."</td> 
		  <td>".$row["ReleaseDate"]." </td> 
		  <td>".$row["noOfLikes"]." </td> 
		  <td>".$row["noOfDislikes"]." </td> 
		  <td> <form method='POST' action='deletelibrary.php'>
		  <input type='hidden' name='sid' value='$idOfSong'/>
		  <input type='submit' value='Remove'> </input> </form> </td> 
	  </tr>";
     }
	
     echo "</table>";
}
else 
	echo "result is 0" ; 

?>

</body>

</html>