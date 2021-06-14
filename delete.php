<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	if (isset($_POST['post_btn'])) 
	{
		header('location: timeline.php');
		create_post();
		exit();
	}
	
	if (isset($_GET['id'])) 
	{
		$profile_data = getUserById($_GET['id']);
		$all_posts = get_posts();
		$all_friends = get_friends();
	}
	else
	{
		$profile_data = $user_data;
		$all_posts = get_posts();
		$all_friends = get_friends();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Timeline</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<!-- top bar -->
	<div id="top_bar">
		<div style="width: 800px;margin:auto;font-size: 30px;">
			<a href="timeline.php" style="color: white";>Artstagram</a> &nbsp &nbsp
			<input type="text" id="search_box" placeholder="Search">
			<a href ="index.php"><img src="images/user_profile.png" style="width: 40px; float: right;"></a>
			<?php  if (isset($_SESSION['user'])) : ?>
				<a href="index.php?logout='1'" style="font-size: 11px; float: right; margin: 10px; color: white;">
				Log Out
				</a>		
			<?php endif ?>
		</div>
	</div>
	<!-- Main Body -->
	<div style="width: 800px; margin: auto; min-height: 400px;">
	<div style="display: flex;">
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<!--make a post--> 
				<div style= "width: 100%; min-height: 90px; border:solid thin #aaa; background-color: white; color: #b1424d;">
					<h2>Delete Post</h2>
					<br>
					<input id="delete_button" type="submit" name="delete_btn" value="Delete">
					<br>
				</div>
			</div>
		</div>
	</div>
</body>
</html>