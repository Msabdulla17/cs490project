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
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($database,$password);

$query = "INSERT into `user` (name, email, password) VALUES ('$name','$email', '".md5($password)."')";
$result = mysqli_query($database,$query);
if($result){
echo "<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a>";
}
}else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
</body>
</html>
