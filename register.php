<!DOCTYPE html>
<html>
<head>
<title>
	Sign Up
</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$database = mysqli_connect("localhost","root","","users");//Connect to database

if (mysqli_connect_errno()) // Check connection
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_REQUEST['submit']))// If form submitted, insert values into the database.
{
  
$name = stripslashes($_REQUEST['name']);// removes backslashes
$name = mysqli_real_escape_string($database,$name); //escapes special characters in a string
$email = stripslashes($_REQUEST['email']);
$email = mysqli_real_escape_string($database,$email);
$password1 = stripslashes($_REQUEST['password1']);
$password1 = mysqli_real_escape_string($database,$password1);
$password2 = stripslashes($_REQUEST['password2']);
$password2 = mysqli_real_escape_string($database,$password2);

$query = "INSERT into `user` (name, email, password1, password2) VALUES ('$name','$email', '".md5($password1)."', '".md5($password2)."')";
$result = mysqli_query($database,$query);
if($result){
echo "<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a>";
}
}else{
?>
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
<form method="post" action="/register.php" >
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
  			<option value="elementary_school">What school did you attend for third grade?</option>
  			<option value="high_school">What school did you attend for ninth grade?</option>
  			<option value="middle_name">What is your oldest sibling's middle name?</option>
  			<option value="street">What street did you live on in third grade?</option>
		</select>
	</div>
	<div class="input-group">
		<label>Answer:</label>
		<input type="text" name="security_answer">
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
