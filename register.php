<!DOCTYPE html>
<?php 
include('functions.php'); 
?>
<html>
<head>
<title>
	Sign Up
</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="logo">
		<br>
		<div style ="font-size: 35px;">Artstagram</div>
		<div style ="font-size: 20px;">Subtitle</div>
		<br>
	</div>
	<br><br>
<div class="header">
	<h2>Sign Up</h2>
</div>
<form method="post" action="register.php" >
	<?php echo display_error(); ?>
	<div class="input-group">
		<label>First Name</label>
		<input type="text" name="first_name" value="" placeholder="Last Name">
	</div>
	<div class="input-group">
		<label>Last Name</label>
		<input type="text" name="last_name" value="" placeholder="First Name">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="" placeholder="you@example.com">
	</div>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="" placeholder="Username">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1" placeholder="Password">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2" placeholder="Password">
	</div>
	<div class="input-group">
		<label>Choose a security question:</label>
		<select name="security_questions" id="security_questions">
			<option value="maiden_name">What is your mother's maiden name?</option>
			<option value="elementary_school">What school did you attend for third grade?</option>
  			<option value="high_school">What school did you attend for ninth grade?</option>
  			<option value="middle_name">What is your oldest sibling's middle name?</option>
  			<option value="street">What street did you live on in 2019?</option>
		</select>
	</div>
	<div class="input-group">
		<label>Answer:</label>
		<input type="text" name="security_answer" placeholder="Answer">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Sign Up</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
<br><br><br><br><br>
</body>
</html>