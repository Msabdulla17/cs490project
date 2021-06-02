<!DOCTYPE html>
<?php 
include('functions.php') 
?>
<html>
<head>
<title>
	Registration system PHP and MySQL
	<script type="text/javascript">
        function validate()
        {
	    var email = document.getElementById("mail");
            var uname = document.getElementById("uname");
            var password = document.getElementById("pass");
</title>
	<link rel="stylesheet" href="style.css">
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
	<h2>Register</h2>
</div>
<form method="post" action="register.php">
	<div class="input-group">
		<label>Email</label>
		<input id="mail" placeholder="Email" value="">
	</div>
	<div class="input-group">
		<label>Username</label>
		<input type="text" placeholder="Username" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>
