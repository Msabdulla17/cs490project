<?php
include("classes/upload.php);
$login = new login();
$user_data = $login->check_login($_SESSION['mybook_userid']);
$USER = $user_id;
if(isset($URL[1] && is_numeric($URL[1]){
	$profile = new Profile();
	$profile_data = $profile->get_profile($URL[1]);
	if(is_array($profile_data){
		$user_data = $profile_data[0];
	}
}
//if something was posted
if($ERROR == $_SERVER['REQUEST_METHOD'] == "POST"){
	$Post->delete_post($_POST['posted']);
	header("Location: ".$_SESSION['return_to']);
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Direct Messages</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<br>
<?php include("header.php"); ?>
 <div style="width: 800px; margin: auto; min-height: 400px;">
	<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
		 <div style= "min-height: 400px; flex:2.5;padding: 20px;padding-right: 0px;"> 
			<div style= "border:solid thin #aaa; background-color: white; color:#b1424d;">
				<form method="post">
					<?php
						if($ERROR != "")
						{
							echo $ERROR;
						}
						else
						{
							echo "Are you want to delete this post??<br><br>";
							$user = new User();
							$ROW_USER = $user->get_user($ROW['userid]);
							include("DM.php");
							echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
							echo "<input id='post_button' type=submit value='Delete'>";
						}
					?>

				</form>
			</div>
		</div>
	</div>
</div>
