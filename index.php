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
	<h1 align="center"> Music Library </h1>
    <div align="center" id="login" > 
    	<div id="table">
		<form name="login" method="post" action="checkLogin.php">
        	<table align="center"> 
            	<tr>
                	<td id="input"> Username : </td> 
                    <td> <input id="input" type="text" name="username" /> </td>  
                </tr>
                <br/>
                <tr>
                	<td id="input"> Password &nbsp;: </td> 
                    <td> <input id="input" type="password" name="password" /> </td> 
                </tr>
                <br/>
                <tr>
                	<td> <input id="unibutton" name="Submit" type="submit" value="Sign In" />  </td> 
                    <td align="center"> <button id="unibutton"><a style="text-decoration:none; color:inherit;" href="signup.php"> Sign Up </a> </button> </td> 
                </tr>
            </table>
        </form>
        </div>
    </div>
<body>

</body>
</html>
