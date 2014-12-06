<?php
	session_start();
	$DB_Server = "localhost"; // MySQL Server
	$DB_Username = "root"; // MySQL Username
	$DB_Password = ""; // MySQL Password
	$DB_DBName = "music library"; // MySQL Database Name
	$xls_filename = 'mylibrary_'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name
	$userID = '10001'; //replace with phpsession
	
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$userID = $_SESSION["userID"];
	$sql = "SELECT Title,Artists,AlbumCover,Length,Genre,ReleaseDate FROM Library,Song WHERE library.songID = song.songID AND userID = '$userID';";
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
	// Select database
	$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
	// Execute query
	$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = "\t"; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	for ($i = 0; $i<mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result, $i) . "\t";
	}
	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysql_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysql_num_fields($result); $j++)
	  {
		if(!isset($row[$j])) {
		  $schema_insert .= "NULL".$sep;
		}
		elseif ($row[$j] != "") {
		  $schema_insert .= "$row[$j]".$sep;
		}
		else {
		  $schema_insert .= "".$sep;
		}
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= "\t";
	  print(trim($schema_insert));
	  print "\n";
	}

?>