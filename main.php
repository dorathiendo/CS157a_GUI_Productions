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
.top{
	color: white;
	font-size: 40px;
	text-align: center;
}
.link{
	text-decoration: none;
	color: white;
}
#newrel{
	color:white;
	font-size: 30px;
	border-radius: 5px;
	border: 2px solid;
	border-color: white;
	width: 200px;
	text-align: center;
	margin-left: auto;
    margin-right: auto;
	margin-top: 10px;
}
</style>
</head>

<body>
<div> 
	    <?php echo "<font id='account'> Welcome". " " . $_SESSION["username"]. "</font>" ?> &nbsp;&nbsp;

		<a id = "account" href="likeme.php"> Similar Users </a>  &nbsp;&nbsp;
        <a id = "account" href="library.php"> My Library </a>   &nbsp;&nbsp;

</div>
<div id = "settings"> 
	  
    	<a id="account" href="account.php"><button type="button">Account Settings</button></a> &nbsp;&nbsp;
    	<a id ="logout" href="logout.php"><button type="button">Logout</button></a> &nbsp;&nbsp;

</div>

<div align="center">
     <form action="main.php" method="post"> 
     	 <input name="submit" type="text" id="search"/>
        <input type="submit" id="unibutton" value="Search"/>
     </form> 
 </div> <br />		
 <div align="center"> 
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
 </div>
<div id="newrel">
	<a href="newrelease.php" class="link">New Releases</a>
</div>
<br /> 
</body>

</html>
 <?php
	
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

$mostlikedquery = "SELECT title, artists FROM Song WHERE songID IN (SELECT songID FROM Likes WHERE noOfLikes IN (SELECT MAX(noOfLikes) FROM Likes));";

$mostlikedresult = $conn->query($mostlikedquery);

if ($mostlikedresult->num_rows > 0) {
while($row = $mostlikedresult->fetch_assoc())
	{
		echo "<div class=\"top\" align=\"center\">
			Current Most Liked Song: ".$row["title"]." by ".$row["artists"]."</div>";
	}
}

if(isset($_SESSION['userID'])) 
{
$sql = "SELECT * FROM Song INNER JOIN Likes ON Song.songID = Likes.songID";


if($searchby == "Pop" || $searchby == "Hip-Hop" || $searchby == "Alternative" || $searchby == "Country" || $searchby == "Indie" || $searchby == "Electronic" || $searchby == "Club" ) 
{
	$sql = "SELECT * FROM song INNER JOIN Likes ON Song.songID = Likes.songID WHERE Genre = '$searchby'"; 	
}
else if(isset($_POST['submit']))
{
	$sql = "SELECT * FROM song INNER JOIN Likes ON Song.songID = Likes.songID WHERE Title LIKE '%$searchby%' OR Artists LIKE '%$searchby%' OR Genre LIKE '%$searchby%' OR ReleaseDate LIKE '%$searchby%'";
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
				</tr>";
     // output data of each row
	 
    while($row = $result->fetch_assoc())
	 {
	 $usertype = $_SESSION["userType"];
	 $idOfSong=$row["songID"];
	 $link = "";
	 if(strcmp($usertype,"Regular"))
	 {
	 	$link = "song.php?songID=".$idOfSong;
	 }
	 if (!strcmp($usertype,"Professional"))
	 {
		 $link = "profsong.php?songID=".$idOfSong;
	 }
      echo "<tr align='center'> 
		  <td> <img width='150px' height='150px' src='" . $row["AlbumCover"]. " '/> </td> 
		  <td><a href = '$link'>" .$row["Title"]. " </a></td>
		  <td>" .$row["Artists"]."</td>
		  <td>".$row["Length"]." </td>
		  <td> ".$row["Genre"]."</td> 
		  <td>".$row["ReleaseDate"]." </td> 
		  <td>".$row["noOfLikes"]." </td> 
		  <td>".$row["noOfDislikes"]." </td> 
	  </tr>";
     }
	
     echo "</table>";
}
else 
	echo "result is 0" ; 

}
else
{
header("location:index.php");
}

?>
<!--<td><a href = 'song.php?songID=".$idOfSong."'>" .$row["Title"]. " </a></td>->
