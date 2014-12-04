<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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
		height:60%;
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
#input {
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
</style>
</head>

<body>
<h1 align="center"> Music Library </h1>
    <div align="center" id="login" > 
    	<div id="table">
		<form method="post" action="signup.php">
        	<table align="center"> 
            	<tr>
                	<td id="input"> Username : </td> 
                    <td>  <input id="input" type="text" name="username" /> </td>  
                </tr>
                <br/>
                <tr>
                	<td id="input"> Email : </td> 
                    <td>  <input id="input" type="text" name="email" /> </td>  
                </tr>
                <br/>
                <tr>
                	<td id="input"> Usertype : </td> 
                    <td>  <select style="width:100%" name="usertype" id="unibutton"> 
                    			<option id="unibutton" value="Regular" >Regular</option>
                                <option id="unibutton" value="Professional">Professional</option>
                           </select> 
                    </td>  
                </tr>
                <br/>
                <tr>
                	<td id="input"> Password : </td> 
                    <td>  <input id="input" type="password" name="userpassword" /> </td> 
                </tr>
                <br/>
                <tr align="center">
                	<td> </td>	<td> <input id="unibutton" type="submit" value="Submit" />  </td>  
                </tr>
            </table>
        </form>
        </div>
    </div>
    <?php
    
	$username = null; 
	$userpassword = null;
	$email = null; 
	$usertype = null;
		
	if(isset($_POST['username']) && isset($_POST['userpassword']) && isset($_POST['usertype']) && isset($_POST['email']) ) 
	{
		$username = $_POST['username'];
		$userpassword = $_POST['userpassword'];
		$email    = $_POST['email'] ; 
		$usertype = $_POST['usertype'];
		//echo "$usertype && $username && $userpassword && $email";
	}
	
	$servername = "localhost";
	$serverusername = "root";
	$password = "admin";
	$dbname = "music library";

// Create connection
$conn = new mysqli($servername, $serverusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT userID FROM user ORDER BY userID DESC LIMIT 1";

$result = $conn->query($sql);
$row = $result->fetch_assoc(); 

$userID = $row["userID"] + 1;

//echo "$usertype && $username && $userpassword && $email";
if(isset($_POST['username']) && isset($_POST['userpassword']) && isset($_POST['usertype']) && isset($_POST['email']))
{
	$sql = "INSERT INTO user (userID, userType, Username, Email, Password) VALUES ('$userID', '$usertype', '$username','$email','$userpassword')";
}
if ($conn->query($sql) === TRUE) 
{
    header("Location: http://localhost/ml/main.php");
}

?>
</body>
</html>