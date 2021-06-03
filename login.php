
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$database = mysqli_connect("localhost","root","","users");//Connect to database

if (mysqli_connect_errno()) // Check connection
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
session_start();
if (isset($_POST['email'])){
  
$email = stripslashes($_REQUEST['email']);// removes backslashes
$email= mysqli_real_escape_string($database,$email); //escapes special characters in a string
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($database,$password);
//Checking is user existing in the database or not
$query = "SELECT * FROM `user` WHERE email='$email'and password='".md5($password)."'";
$result = mysqli_query($database,$query) or die(mysqli_error());
$rows = mysqli_num_rows($result);
if($rows==1){
$_SESSION['email'] = $email;

header("Location: index.php"); // Redirect user to index.php
}
else
{
echo "<div>
<h3>email/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
}
}
else
{
?>
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
