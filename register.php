<!DOCTYPE html>
<?php 
include('functions.php'); 
?>
<html>
<head>
<title>
	Sign Up
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
	<h2>Sign Up</h2>
</div>
<form method="post" action="register.php">
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="">
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
		<label>Choose a security question:</label>
		<select name="security_questions" id="security_questions">
  			<option value="elementary_school">What school did you attend for third_grade?</option>
  			<option value="high_school">What school did you attend for ninth grade?</option>
  			<option value="middle_name">What is your oldest sibling's middle name?</option>
  			<option value="street">What street did you live on in third grade?</option>
		</select>
	</div>
	<div class="input-group">
		<label>Answer:</label>
		<input type="password" name="security_answer">
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
