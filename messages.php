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
	<form style="width:100%; background-color: #b1424d;" method = "get" action="search.php">	
		<div id="top_bar">
			<div style="width: 800px; height: 50px; margin:auto; font-size: 30px;">
				<a href="timeline.php" style="color: white";>Artstagram</a>
				&nbsp &nbsp 
				<input type="text" name="find" id="search_box" placeholder="Search">
				<a href ="index.php"><img src="images/user_profile.png" style="width: 40px; float: right;"></a>
				<?php  if (isset($_SESSION['user'])) : ?>
					<a href="index.php?logout='1'" style="font-size: 11px; float: right; margin: 10px; color: white;">
					Log Out
					</a>		
				<?php endif ?>
			</div>
		</div>
	</form>
	<!-- Main Body -->
	<div style="width: 800px; margin: auto; min-height: 400px;">
	<div style="display: flex;">
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<div> 
					<form style= "width: 100%;" method= "post">
						<hr>
							<?php
								if($ROW2)
								{
									echo "Are you sure you want to delete this post?<br>";
									foreach ($ROW2 as $ROW)
									{
										$ROW_USER = getUserById($ROW['users_id']);
										include("post_delete.php");
									}
								}
								else
								{
									array_push($errors, "No post was found.");
									header("index.php");
								}
							?>
						<hr>
						<input type ="hidden" name="post_id" value=<?php echo $post_id ?>>
						<input id="delete_button" type="submit" name="delete_btn" value="Delete">
						<br>
					</form>
                <br style="clear: both;">
				</div>
			</div>
		</div>
	</div>
</body>
</html>
