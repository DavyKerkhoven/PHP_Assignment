<?php

	include("../../conf/settings.php");
	$connection = mysqli_connect($host, $user, $pswd, $dbnm);

	if(!$connection)
	{
		echo "connection error";
	}
	
	$sqlString = "SELECT * FROM status";
	$result = mysqli_query($connection, $sqlString);
	if (mysqli_num_rows($result) > 0)
	{	
		setupPage();
		$searchQuery = $_GET['searchStatus'];
		$sqlString = "SELECT * FROM `status` WHERE status LIKE '%$searchQuery%' ";
		$result = mysqli_query($connection, $sqlString);
		$row = mysqli_fetch_row($result);
		echo "<div class=\"searchResults\" >";
		while ($row)
		{
			
			echo "<br>Status Code: " . $row[0];
			echo "<br>Status: " . $row[1];
			echo "<br>";
			echo "<br>Share: " . $row[2];
			echo "<br>Date Posted: " . $row[3];
			echo "<br>Permsission: " . $row[4];
			echo "<br><br>";
			
			$row = mysqli_fetch_row($result);
		}
		echo "<a href=\"index.html\"><button type=\"button\" class=\"button\">Return to Home Page</button></a>
				<br>
				<br>
				<a href=\"searchstatusform.html\"><button class=\"button\">Try again</button></a>
				</html>";
		echo "</div>";
		
	}
	else
	{
		showErrorPage("The table does not exist!");
		exit();
	}
	
	
		
	
	//FUNCTIONS
	function setupPage()
	{
		echo 	
		"<html>
		<head>
		<title>Search Results</title><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
		<head>
		<body>
			<header>
			<h1>Status Posting System</h1>
			</header>
			<h2>Search Result</h2>
		</body>
		</html>";
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
		<a href=\"searchstatusform.html\"><button class=\"button\">Try again</button></a>
		</html>";
	}
?>
