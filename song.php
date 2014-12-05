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
		
#likes{
	height:5px;
	width:50%;
	background:#00FF00;
	float:left;
}
#dislikes{
	height:5px;
	width:50%;
	background:#FF0000;
	float:right;
}

#bar{
	width:400px;
}

#all{
float:right;
margin-right:100px;
margin-bottom: 20px;
}

}
</style>
</head>

<body onload="activate()">
<div align="center"> 
     <form action="main.php" method="post"> 
     	 <input name="submit" type="text" id="search"/>
        <input type="submit" id="unibutton" value="Search"/>
     </form> 
 </div> <br />

<div id="all">
	<div id = "likebuttons" class="inner">
	<input type="button" value="Like" id="likeButton" onclick="like();"/>
	<input type="button" value="Dislike" id="dislikeButton" onclick="dislike();"/>
	</div>
	<div id="bar" class="inner">
		<div id="likes"></div>
		<div id="dislikes"></div>
	</div>
</div>
</body>
 
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

if(isset($_GET["songID"])) {
		$song_id = $_GET["songID"];
$sql = "SELECT * FROM Song INNER JOIN Likes ON Song.songID = Likes.songID WHERE Song.songID = '".$song_id."'";
}
else if(isset($_POST['submit']))
{
	//echo "searchby is: ". $searchby;
	$sql = "SELECT * FROM song INNER JOIN Likes ON Song.songID = Likes.songID WHERE Title LIKE '%$searchby%' OR Artists LIKE '%$searchby%' OR Genre LIKE '%$searchby%' OR ReleaseDate LIKE '$%searchby%'";
    	
	echo $sql;
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
	 $likes=$row["noOfLikes"];
	 $dislikes=$row["noOfDislikes"];
      echo "<tr align='center'> 
		  <td> <img width='150px' height='150px' src='" . $row["AlbumCover"]. " '/> </td> 
		  <td>" .$row["Title"]. " </td>
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

?>
</body>
<script type="text/javascript">
var likes="<?php echo $likes; ?>", 

dislikes="<?php echo $dislikes; ?>";

//Functions to increase likes and immediately calculate bar widths
function like(){
	likes++;
	calculateBar();
}
function dislike(){
	dislikes++;
	calculateBar();
}

function activate()
{
like();
likes--;
dislike();
dislikes--;
}
//Calculates bar widths
function calculateBar(){
	var total= likes+dislikes;
    //Simple math to calculate percentages
	var percentageLikes=(likes/total)*100;
	var percentageDislikes=(dislikes/total)*100;

    //We need to apply the widths to our elements
	document.getElementById('likes').style.width=percentageLikes.toString()+"%";
	document.getElementById('dislikes').style.width=percentageDislikes.toString()+"%";
    
    //We add the numbers on the buttons, just to show how to
    document.getElementById('likeButton').value="Likes ("+likes.toString()+")";
    document.getElementById('dislikeButton').value="Disikes ("+dislikes.toString()+")";

}

calculateBar();
</script>
</html>
