<!DOCTYPE html>
<html>
<head>
	<title>Post Status</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<head>

<header>
	<h1>Status Posting System</h1>
</header>

<body>
	<div class="formBody">
		<form action="poststatusprocess.php" method="post">

		<label>Status Code (required):</label><input type="text" name="statusCode" required><br>
		<label>Status (required):</label><input type="text" name="status" required><br>
		<br>
		<label>Share:</label><input type="radio" name="share" value="Public">Public
		<input type="radio" name="share" value="Friends">Friends
		<input type="radio" name="share" value="OnlyMe">Only Me
		<br>
		<label>Date: </label><input type="date" name="date" value="<?php echo date('Y-m-d');?>">
		<br>
		<label>Permission Type:</label><input type="checkbox" name="allowLike" value="Like"> Allow Like
		<input type="checkbox" name="allowComment" value="Comment"> Allow Comment
		<input type="checkbox" name="allowShare" value="Share"> Allow share							
		<br>
		<br>
		<div class="buttons">
			<input type="submit" class="button"  value="Post">
			<br>
			<br>
			<input type="reset" class="button" value="Reset">
			<a href="index.html"><button type="button" style="right: 10px" class="button">Return to Home Page</button></a>	
		</div>
	</div>	
</html>