<?php 
	include('functions.php');
	if (!isLoggedIn()){
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="canvas1"></div>
	<script src="script.js"></script>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<p class="Introduction">
    You will will be able to select the most popular song(s)
    and or artist of the day, of the week, of the month and of the year, 
     but you have to register first.
</p>
<a href="register.php">Click here to register</a>
<p class="Registered">Already registered?</p>
	<a href="login.php">Click here to log in</a>

</body>
</html>
