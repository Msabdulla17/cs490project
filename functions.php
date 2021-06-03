<?php
session_start();
if(!isset($_SESSION["user"])){
header("Location: login.php");
exit(); }
?>
/*<?php 
session_start();

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);

$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$db = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// variable declaration
$username = "";
$email    = "";
$security_answer = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

//check for admin status
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		echo "Username is required" ;
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: /admin/home.php');
				exit();		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: /index.php');
				exit();
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: /login.php");
	exit();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email, $security_answer;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$security_answer = e($_POST['security_answer']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if (empty($security_answer)) { 
		array_push($errors, "Please provide a security answer"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) 
		{
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO public.user_list (username, email, user_type, password, security_answer) 
					  VALUES('$username', '$email', '$user_type', '$password', '$security_answer')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: /admin/home.php');
			exit();
		}
		else
		{
			$query = "INSERT INTO user_list (username, email, user_type, password, security_answer) 
					  VALUES('$username', '$email', 'user', '$password', '$security_answer')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);
			
			// put logged in user in session
			$_SESSION['user'] = getUserById($logged_in_user_id); 

			$_SESSION['success']  = "You are now logged in";
			header('location: /index.php');
			exit();				
		}
	}
}

// return user array from their id
function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val)
{
	global $db;
	return mysqli_escape_string($db, trim($val));
}

function display_error() 
{
	global $errors;

	if (count($errors) > 0)
	{
		echo '<div class="error">';
			foreach ($errors as $error)
			{
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

    
*/
