<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
	$profile_data = $user_data;
	$ROW2 = false;
    if (isset($_GET['user_id']))
    {
        $post_id = $_GET['user_id'];
        $ROW2 = get_post($post_id);
    }
    else
    {
        array_push($errors, "No post was found.");
    }
	if ($_SERVER['REQUEST_METHOD'] == "POST") 
 	{
 		header("location: index.php");
 		delete_post($post_id);
 		exit();
 		die();
 	}
 
if(isset($URL[1] && is_numeric($URL[1]){
	$profile = new Profile();
	$profile_data = $profile->get_profile($URL[1]);
	if(is_array($profile_data){
		$user_data = $profile_data[0];
	}
}
	   //if message was sent
/*if($ERROR == "" && $_SERVER['REQUEST_METHOD'] == "POST"){
	delete_post($post_id);
	show($_POST);
	show($_FILES);
	$msg_class= new Messages();
	$msg_class->send($_POST,$_GET);
	//header("Location: ".$_SESSION['return_to']);
	die;
}*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Direct Messages</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<br>
<?php include("index.php"); ?>
 <div style="width: 800px; margin: auto; min-height: 400px;">
	<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
		 <div style= "min-height: 400px; flex:2.5;padding: 20px;padding-right: 0px;"> 
			<div style= "border:solid thin #aaa; background-color: white; color:#b1424d;">
				<form method="post" enctype="multipart/form-data">
					<?php
						if($ERROR != "")
						{
							echo $ERROR;
						}
						else
						{
							if(isset($URL[1]) && $URL[1] == "new"){
								echo "Start New Message with:<br><br>";
								if(isset($URL[2]) && is_numeric($URL[2])
								{
									$user = new User();
									$FRIEND_ROW = $user->get_user($URL[2]);
								}
								include "user.php";
								   echo '';
								<div style= "border:solid thin #aaa; padding: 10px; background-color: white; color:#b1424d;">
									<form method="POST">
								 	  <textarea name="message" placeholder="Write your message here"></textarea>
								 	  <input type="file" name="file" multiple>
								 	  <input id="post_button" type="submit" value="Send">
								   	</form>
								   </div>;
								else
								{
									echo "That user could not be found<br><br>";
								}
							}
							else
							{
								echo "Messages<br><br>";
								$user = new User();
								$ROW_USER = $user->get_user($ROW['users_id']);
							}
							include("message.php");
							echo "<input type='hidden' name='post_id' value='$ROW[post]'>";
							echo "<input id='post_button' type=submit value='Delete'>";
						}
					?>

				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
