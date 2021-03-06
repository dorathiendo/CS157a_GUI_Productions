<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Music Library</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

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

#userTable
{
float:bottom;
width: 50%;
margin-top:100px;
margin-left:94px;

}

#reviewDiv
{
float:right;
margin-top:50px;
margin-right:32px;
}

textarea {
    resize: none;
	height:200px;
	width:500px;
}

</style>
</head>

<body>
<div align="center"> 
     <form action="main.php" method="post"> 
     	 <input name="submit" type="text" id="search"/>
        <input type="submit" id="unibutton" value="Search"/>
     </form> 
 </div> <br />


 
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
					<th>Add to Library</th>
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
		  <td>
			<form method=\"POST\" action=\"library.php\">
				<input type=\"hidden\" name=\"sid\" value=".$row["songID"]."/>
				<input type=\"submit\" value=\"Add\"/>				
			</form>
		  </td>
	  </tr>";
     }
	
     echo "</table>";
}
else 
	echo "result is 0" ; 
	
//User Reviews 	
$sql = "SELECT Username, Review FROM user,UserReview WHERE songID = '".$song_id."' and UserReview.userID=user.userID" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table id='userTable'>
	 			<tr>
					<th>User</th>
					<th>Review</th>
</tr>";
while($row = $result->fetch_assoc())
	 {
      echo "<tr align='center'> 
		   <td>" .$row["Username"]."</td>
		   <td>" .$row["Review"]. " </td>
		   </tr>";
     }
	
     echo "</table>";
}	 
echo "
</br>	

<div align='center' style='background-color:#FAFAFA;'>

<form method='post' action='profreview.php'>
Star Review:
<select id='unibutton' name='stars'>
  <option value='1'>1 Star</option>
  <option value='2'>2 Star</option>
  <option value='3'>3 Star</option>
  <option value='4'>4 Star</option>
  <option value='5'>5 Star</option>
</select>
<input type='hidden' name='sid' value='$song_id'/>
<input id='unibutton' type='submit' name='submit' value='Submit'>
</form>
"
?>
</div>
</body>
</html>
