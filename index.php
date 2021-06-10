<?php 
	include('functions.php');

	if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	if (isset($_POST['post_btn'])) 
	{
		header('location: index.php');
		$result = create_post();
	}
	$all_posts = get_posts();
	$all_friends = get_friends();

	var_dump($profile_data);
	var_dump($all_posts);
	var_dump($all_friends);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<!-- notification message -->
	<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
	<?php endif ?>

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
		<!-- Cover photo and profile picture -->
		<div style="background-color: white; text-align: center; color: #b1424d;">
			<img src="images/cover_photo.png" style="width:100%;">
			<img id="profile_picture" src="images/user_profile.png">
			<br>
				<div style="font-size: 20px;">
					<?php 
						echo $user_data['first_name'] + " " + $user_data['last_name']; 
					?>
					<small>
						<i  style="color: #888;">(<?php echo $user_data[5]; ?>)</i>
					</small>
				</div>
			<br>
			<div id="menu_buttons"><a href="/timeline.php" style="color:#b1424d;">Feed</a></div>
			<div id="menu_buttons"><a href="" style="color:#b1424d;">About</a></div>
			<div id="menu_buttons"><a href="" style="color:#b1424d;">Friends</a></div>
			<div id="menu_buttons"><a href="" style="color:#b1424d;">Photos</a></div>
			<div id="menu_buttons"><a href="" style="color:#b1424d;">Settings</a></div> 
		</div>
		<br>
		<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
			<!--friends--> 
			<div style= "background-color: white; color:#b1424d; min-height: 400px; flex: 1;">
				<div id="friends_bar">
					Friends
					<br>
					<?php
						if($all_friends)
						{
							foreach ($all_friends as $FRIEND_ROW)
							{
								include('user.php');
							}
						}
					?>

				</div>
			</div>
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<!--make a post--> 
				<div style= "width: 100%; min-height: 90px; border:solid thin #aaa; background-color: white;">
					<form style= "width: 80%;" action="index.php" method ="post">
						<textarea name="post" placeholder="Make a post here."></textarea>
						<input id="post_button" type="submit" class="btn" name="post_btn" value="Post">
						<br>
					</form>
				</div>

				<!--feed area w/ recent posts-->
				<div id="post_bar">
					<div style= "color: #b1424d; float:left;">Posts</div>
					<br>
					<?php
						if($all_posts)
						{
							foreach ($all_posts as $ROW)
							{
								$ROW_USER = getUserById($ROW['user_id']);
								include('post.php');
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>