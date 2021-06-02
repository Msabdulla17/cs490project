<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
        function validate()
        {
            var uname = document.getElementById("uname");
            var password = document.getElementById("pass");
	}
	</script>
</head>
<body>
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
		
		<div class="input-group">
			<label>Username</label>
			<input type="uname" name="user">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="pass" name="password">	
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
