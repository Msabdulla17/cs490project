<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<div id="logo">
		<br>
		<div style ="font-size: 35px;">Artstagram</div>
		<div style ="font-size: 20px;">A Social Media Website for Artists</div>
		<br>
	</div>
	<br><br>
	<div class="header">
		<h2>Log In</h2>
	</div>
	<form action="login.php" method="post">
		<?php echo display_error(); ?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
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
	<br><br><br><br>
</body>
</html>
