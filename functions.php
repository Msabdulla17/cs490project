<?php 
require('vendor/autoload.php');
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
$user_id = ($_SESSION['user']['id']);
$data = "";



// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) 
{
	register();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) 
{
	login();
}

function delete_user($id)
{
	global $db;

	$query = "DELETE FROM user_list
			WHERE id = '$id'";
	mysqli_query($db, $query);
}

function i_own($message_row)
{
	global $user_id;

	if ($message_row['sender'] == $user_id)
	{
		return true;
	}
}

function read_message($receiver)
{
	global $db, $user_id;
	$sender = addslashes($user_id);
	$receiver = addslashes($receiver);

	$query = "SELECT * FROM messages 
		WHERE (sender = '$sender' AND receiver = '$receiver') ||
		(receiver = '$sender' AND sender = '$receiver') ORDER BY id DESC LIMIT 20";
	$data = mysqli_query($db, $query);

	return $data;
}

function read_threads()
{
	global $db, $user_id;
	$sender = addslashes($user_id);

	$query = "SELECT * FROM messages 
		WHERE (sender = '$sender' || receiver = '$sender') GROUP BY message_id ORDER BY id DESC LIMIT 20";
	$data = mysqli_query($db, $query);

	return $data;
}

function get_thumbnail($file_name)
{
	$thumbnail = $file_name . "_thumb.jpg";
	resize_image($file_name, $thumbnail, 500, 500);
	if (file_exists($thumbnail))
	{
		return $thumbnail;
	}
	else
	{
		return $file_name;
	}
}

function resize_image($original_file,$cropped_file,$max_width,$max_height)
{
	if (file_exists($original_file))
	{
		$original_image = imagecreatefromjpeg($original_file);
		$original_width = imagesx($original_image);
		$original_height = imagesy($original_image);

		if($original_height > $original_width)
		{
			$ratio = $max_width / $original_width;
			$new_width = $max_width;
			$new_height = $original_height * $ratio;
		}
		else
		{
			$ratio = $max_height / $original_height;
			$new_height = $max_height;
			$new_width = $original_width * $ratio;
		}
	}
	$new_image = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
	imagedestroy($original_image);
	imagejpeg($new_image, $cropped_file, 90);
	imagedestroy($new_image);
}

function resize_profile_image($original_file,$cropped_file,$max_width,$max_height)
{
	if (file_exists($original_file))
	{
		$original_image = imagecreatefromjpeg($original_file);
		$original_width = imagesx($original_image);
		$original_height = imagesy($original_image);

		if($original_height > $original_width)
		{
			$ratio = $max_width / $original_width;
			$new_width = $max_width;
			$new_height = $original_height * $ratio;
		}
		else
		{
			$ratio = $max_height / $original_height;
			$new_height = $max_height;
			$new_width = $original_width * $ratio;
		}
	}
	$new_image = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
	imagedestroy($original_image);

	if($new_height > $new_width)
	{
		$diff = ($new_height - $new_width);
		$y = round($diff / 2);
		$x = 0;
	}
	else
	{
		$diff = ($new_width - $new_height);
		$x = round($diff / 2);
		$y = 0;
	}

	$new_cropped_image = imagecreatetruecolor($max_width, $max_height);
	imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);
	imagedestroy($new_image);
	imagejpeg($new_cropped_image, $cropped_file, 90);
	imagedestroy($new_cropped_image);
}

function generate_filename($length)
{
	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$text = "";
	$length = rand(4,$length);

	for($x = 0; $x < $length; $x++)
	{
		$random = rand(0,61);
		$text .= $array[$random];
	}

	return $text;
}

function send_message($data, $file, $receiver)	
{
	global $db, $errors, $user_id;

	if(!empty($data['message']) || !empty($file['file']['name']))
	{
		$message_id = generate_filename(60);
		$my_image = "";
		if (!empty($file['file']['name']))
		{
			$folder = "uploads/" . $user_id . "/";
			if(!file_exists($folder))
			{
				mkdir($folder, 0777, true);
			}
			$allowed[] = "image/jpeg";

			if(in_array($file['file']['type'], $allowed))
			{
				$my_image = $folder . generate_filename(15) . ".jpg";
				move_uploaded_file($file['file']['tmp_name'], $my_image);
			}
			else
			{
				array_push($errors, "Please select .jpg and .jpeg images only.");
			}
		}
		$message = "";
		if (isset($data['message']))
		{
			$message = addslashes($data['message']);
		}

		$message_id = addslashes($message_id); 
		$sender = addslashes($user_id); 
		$receiver = addslashes($receiver);
		$file = addslashes($my_image);
		
		$query = "SELECT * FROM messages 
		WHERE (sender = '$sender' AND receiver = '$receiver') ||
		(receiver = '$sender' AND sender = '$receiver') LIMIT 1";
		$result = read($query);

		if(is_array($result))
		{
			$message_id = $result[0]['message_id'];
		}

		$query = "INSERT INTO messages (message_id, sender, receiver, message, file)
					VALUES ('$message_id', '$sender', '$receiver', '$message', '$file')";
		mysqli_query($db, $query);
	}
	else
	{
		array_push($errors, "Message cannot be empty.");
	}
}

function save($query)
{
	global $cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db;
	$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

	$result = mysqli_query($conn,$query);

	if(!$result)
	{
		return false;
	}
	else
	{
		return true;
	}

}

function read($query)
{
	global $cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db;
	$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

	$result = mysqli_query($conn,$query);

	if(!$result)
	{
		return false;
	}
	else
	{
		$data = false;
		while($row = mysqli_fetch_assoc($result))
		{
			$data[] = $row;
		}
		return $data;
	}

}

function like_post($id, $like_type)
{
	global $db, $user_id;

	if ($like_type == 'post')
	{
		$query = "SELECT likes FROM likes
				WHERE like_type = 'post' && content_id = '$id' LIMIT 1";
		$result = read($query);
		if(is_array($result))
		{
			$likes = json_decode($result[0]['likes'],true);
			$liker_user_ids = array_column($likes, "user_id");
			if(!in_array($user_id, $liker_user_ids))
			{
				$arr["user_id"] = $user_id;
				$arr["date"] = date("Y-m-d H:i:s");
				$likes[] = $arr;
				$likes_string = json_encode($likes);

				$query = "UPDATE likes SET likes = '$likes_string'
						WHERE like_type = 'post' && content_id = '$id' LIMIT 1";
				mysqli_query($db, $query);

				$query = "UPDATE posts SET likes = likes + 1 
						WHERE post_id = '$id' LIMIT 1";
				mysqli_query($db, $query);
			}
			else
			{
				exit();
			}
		}
		else
		{
			$arr["user_id"] = $user_id;
			$arr["date"] = date("Y-m-d H:i:s");
			$arr2[] = $arr;
			$likes_string = json_encode($arr2);

			$query = "INSERT INTO likes (like_type, content_id, likes)
					VALUES ('$like_type','$id', '$likes_string')";
			mysqli_query($db, $query);

			$query = "UPDATE posts SET likes = likes + 1 
					WHERE post_id = '$id' LIMIT 1";
			mysqli_query($db, $query);

		}
	}
	exit();
}	

function create_random_id()
{
	$length = rand(4,19);
	$number = "";
	for ($i=0; $i < $length; $i++)
	{
		$new_rand = rand(0,9);
		$number = $number . $new_rand;
	}

	return $number;
}

function get_friends()
{
	global $db, $profile_data;
	$profile_id = $profile_data['id'];

	$query = "SELECT * FROM user_list
					WHERE id != '$profile_id' ORDER BY id DESC";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function is_my_post($post_id)
{
	global $user_id;

	$query = "SELECT * FROM posts
		WHERE post_id = '$post_id' LIMIT 1";
	$result = read($query);
	if(is_array($result))
	{
		if($result[0]["users_id"] == $user_id)
		{
			return true;
		}
	}
	else
	{
		return false;
	}
}

function get_likes($id, $like_type)
{
	if ($like_type == 'post')
	{
		$query = "SELECT likes FROM likes
				WHERE like_type = 'post' && content_id = '$id'";
		$result = read($query);
		if(is_array($result))
		{
			$likes = json_decode($result[0]['likes'],true);
 			return $likes;
		}
		else
		{
			return false;
		}
	}
	exit();
}

function delete_post($post_id)
{
	global $db;

	$query = "DELETE FROM posts
		WHERE post_id = '$post_id' LIMIT 1";
	mysqli_query($db, $query);
}

function get_post($post_id)
{
	global $db;

	$query = "SELECT * FROM posts
		WHERE post_id = '$post_id' LIMIT 1";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function get_comments($post_id)
{
	global $db;

	$query = "SELECT * FROM posts
		WHERE parent = '$post_id'
		ORDER BY id ASC";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function get_all_posts()
{
	global $db;

	$query = "SELECT * FROM posts
		WHERE parent = '0'
		ORDER BY id DESC";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function get_all_users()
{
	global $db;

	$query = "SELECT * FROM user_list
		ORDER BY id DESC";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function get_users_posts()
{
	global $db, $profile_data;
	$profile_id = $profile_data['id'];

	$query = "SELECT * FROM posts
		WHERE users_id = '$profile_id' AND parent = '0'
		ORDER BY id DESC";
	$result = mysqli_query($db, $query);

	if($result)
	{
		return $result;
	}
	else
	{
		return false;
	}
}

function create_post()	
{
	global $errors, $user_id;
	$data = $_POST['post'];
	$files = $_FILES['file']['name'];
	$post_id = create_random_id();

	if(isset($_POST['parent']))
	{
		$parent = $_POST['parent'];
	}
	else
	{
		$parent = 0;
	}

	if (empty($data) || empty($files))
	{
		array_push($errors, "Post cannot be empty.");
	}

	if (count($errors) == 0)
	{
		$my_image = "";
		$has_image = 0;

		if (!empty($files))
		{
			$folder = "uploads/" . $user_id;
			if (!file_exists($folder))
			{
				mkdir($folder, 0777, true);
			}
			$my_image = $folder . generate_filename(15) . ".jpg";
			move_uploaded_file($_FILES['file']['tmp_name'], $my_image);

			$has_image = 1;
		}

		$post = addslashes($data);
		$query = "INSERT INTO posts (post_id, users_id, post, parent, image_link, contains_image)
					VALUES ($post_id, $user_id, '$post', '$parent', '$my_image', '$has_image')";
		save($query);
		exit();
	}
	if (!empty($_SERVER['HTTP_REFERER']))
	{
    	header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	else
	{
		header("Location: index.php?id=".$user_id);
	}
}

function displayUser()
{
	if (isset($_SESSION['user'])) :

		return $_SESSION['user']['username'] && $_SESSION['user']['user_type'];
	endif;
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
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM user_list WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
				exit();		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
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
	header("location: login.php");
	exit();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email, $security_answer, $first_name, $last_name, $url_address;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$security_answer = e($_POST['security_answer']);
	$first_name = e($_POST['first_name']);
	$last_name = e($_POST['last_name']);
	$url_address = e($_POST['url_address']);

	// form validation: ensure that the form is correctly filled
	if (empty($first_name)) 
	{ 
		array_push($errors, "First Name is required."); 
	}
	if (empty($last_name)) 
	{ 
		array_push($errors, "Last Name is required."); 
	}
	if (empty($email)) 
	{ 
		array_push($errors, "Email is required."); 
	}
	if (empty($username)) 
	{ 
		array_push($errors, "Username is required."); 
	}
	if (empty($password_1)) 
	{ 
		array_push($errors, "Password is required."); 
	}
	if (empty($security_answer)) 
	{ 
		array_push($errors, "Please provide a security answer."); 
	}
	if ($password_1 != $password_2) 
	{
		array_push($errors, "The two passwords do not match.");
	}
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
	{
		array_push($errors, "Invalid Email.");
	}
	if (is_numeric($last_name) || is_numeric($first_name)) 
	{ 
		array_push($errors, "Your name cannot contain any numbers."); 
	}
	if (strrpos($username, ' ') !== false)
	{
		array_push($errors, "Your username cannot contain any spaces."); 
	}
	if (strrpos($first_name, ' ') !== false)
	{
		array_push($errors, "Your first name cannot contain any spaces."); 
	}
	if (strrpos($last_name, ' ') !== false)
	{
		array_push($errors, "Your last name cannot contain any spaces."); 
	}


	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password before saving in the database
		$password = md5($password_1);
		$url_address = strtolower($first_name) . "." . strtolower($last_name);
		
		if (isset($_POST['user_type'])) 
		{
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO user_list (username, email, user_type, password, security_answer, first_name, last_name, url_address) 
					  VALUES('$username', '$email', '$user_type', '$password', '$security_answer', '$first_name', '$last_name', '$url_address')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: index.php');
			exit();
		}
		else
		{
			$query = "INSERT INTO user_list (username, email, user_type, password, security_answer, first_name, last_name, url_address) 
					  VALUES('$username', '$email', 'user', '$password', '$security_answer', '$first_name', '$last_name', '$url_address')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);
			
			// put logged in user in session
			$_SESSION['user'] = getUserById($logged_in_user_id); 

			$_SESSION['success']  = "You are now logged in";
			header('location: index.php?id=' . $logged_in_user_id);
			exit();				
		}
	}
}

// return user array from their id
function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM user_list WHERE id=" . $id;
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

    
