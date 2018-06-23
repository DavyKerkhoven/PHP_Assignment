<?php
	//ENTRY POINT 

	if(is_valid($_POST['statusCode'], $_POST['status']))
	{
		if(is_unique($_POST['statusCode']))
		{
			include("../../conf/settings.php");
			$connection = mysqli_connect($host, $user, $pswd, $dbnm);

			if(!$connection)
			{
				echo "connection error";
			}
			
			
			$statusCode = $_POST['statusCode'];
			$status = $_POST['status'];
			$share = $_POST['share'];
			$date = date('d-F-Y', strtotime($_POST['date']));
			$permission = $_POST['allowLike'] ." ". $_POST['allowComment'] ." ". $_POST['allowShare'];
			
			$sqlString = "INSERT INTO status (statusCode, status, share, date, permissions) VALUES ('$statusCode', '$status', '$share', '$date', '$permission')";
			$result = mysqli_query($connection, $sqlString);

			if ($result)
			{
				showErrorPage("Record inserted successfully!");
			} else 
			{
				showErrorPage("Something went wrong, the record was not inserted!");
			}
			
			mysqli_free_result;		
			mysqli_close($connection);
		}
	}
	
	//FUNCTIONS
	function is_valid($statusCode, $statusString)
	{				
		if(substr($statusCode, 0, 1) !== "S")
		{
			showErrorPage("Status Code must start with an S!");
			return false;	
		}
		
		
		$numbers = substr($statusCode, 1, 4);
		if(!is_numeric($numbers))
		{
			showErrorPage("You must put 4 numbers after the S!");
			return false;
		}
		
		$pattern = '/^[A-Za-z0-9\040\.\,\?\!]+$/i';
		if (!preg_match($pattern, $statusString))
		{
			showErrorPage("Illegal character found! Please only use: letters, numbers, '?' or ',' or '.' or '!' ");
			return false;
		}
		
		return true;
	}
	
	function is_unique($statusCode)
	{
		include("../../conf/settings.php");
		$connection = mysqli_connect($host, $user, $pswd, $dbnm);
		if(!$connection)
		{
			echo mysqli_connect_error();
		}
		/*else  //For testing:
		{
			echo "<p>Successfully opened the database.</p>";
		}*/
		
		$sqlString = "
		CREATE TABLE IF NOT EXISTS cdk5960.status (
		statusCode CHAR(5) NOT NULL,
		PRIMARY KEY(statusCode),
		status  VARCHAR(40) NOT NULL,
		share 	VARCHAR(40),		
		date  VARCHAR(20) NOT NULL,
		permissions VARCHAR(20) )";
		
		$queryResult = @mysqli_query($connection, $sqlString)
			or die("<p>Unable to execute the query.</p>"
			. "<p>Error code " . mysqli_errno($connection)
			. ": " . mysqli_error($connection)) . "</p>";
		//testing:
		//echo "<p>Successfully created the table or it already exists.</p>";
		
		$sqlString = "SELECT * FROM `status` WHERE `statusCode`='$statusCode'";
		$queryResult = mysqli_query($connection, $sqlString);
		
		if(mysqli_fetch_array($queryResult) == true)
		{
			echo "That status code has already been used!";
			echo "<br>Please try again.";
			echo "<br><a href='index.html'>Return to Home Page</a>";
			echo "<br><a href='poststatusform.php'>Return to Post Status Page</a>";
			mysqli_close($connection);
			return false;
		}
		else
		{
			mysqli_close($connection);
			return true;
		}	
	}
	
	function showErrorPage($message)
	{
		echo "
		<html>
		<head>
		<title>Search Status</title><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
		<head>
		<h2>".$message."</h2>
		<br>Please try again.
		<br>
		<br>
		<a href=\"index.html\"><button type=\"button\" class=\"button\">Return to Home Page</button></a>
		<br>
		<br>
		<a href=\"poststatusform.php\"><button class=\"postButton\">Post a new status</button></a>
		</html>";
	}
	
	
	
	
	


?>