
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include('../functions.php') ?>
	//This will help try to connect back to the database that we are developing.
	<div id="logo">
		<br>
		<div style ="font-size: 35px;">Title for website</div>
		<div style ="font-size: 20px;">Subtitle</div>
		<br>
	</div>
	<br><br>
	<div class="header">
		<h2>Log In</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php echo display_error(); ?>
		////creating a display to an error if password or username is incorrect.
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
		//creating a display the login username and the password.
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
</body>
</html>
