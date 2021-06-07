<?php 
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] == ['POST'])
	{
		$result = create_post($session_id, $_POST);
	}
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
			Artstagram &nbsp &nbsp
			<input type="text" id="search_box" placeholder="Search">
			<img src="images/user_profile.png" style="width: 40px; float: right;">
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
			<?php  if (isset($_SESSION['user'])) : ?>
				<div style="font-size: 20px;">
					<?php 
						echo $_SESSION['user']['first_name'];
						echo " ";
						echo $_SESSION['user']['last_name']; 
					?>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
					</small>
				</div>
			<?php endif ?>

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
			<div style= "color:#b1424d; min-height: 400px; flex: 1;">
				<div id="friends_bar">
					Friends
					<br>
					<div id="friends">
						<img id="friends_img" src="images/user_profile.png">
						<br>
						First User
					</div>

					<div id="friends">
						<img id="friends_img" src="images/user_profile.png">
						<br>
						Second User
					</div>

					<div id="friends">
						<img id="friends_img" src="images/user_profile.png">
						<br>
						Third User
					</div>

					<div id="friends">
						<img id="friends_img" src="images/user_profile.png">
						<br>
						Fourth User
					</div>
				</div>
			</div>
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<!--make a post--> 
				<div style= "width: 100%; min-height: 90px; border:solid thin #aaa; background-color: white;">
					<form method ="post">
						<textarea name="post" placeholder="Make a post here."></textarea>
						<input id="post_button" type="submit" name="post_button" value="Post">
						<br>
					</form>
				</div>

				<!--feed area w/ recent posts-->
				<div id="post_bar">
					<div style= "color: #b1424d; float:left;">Posts</div>
					<br>
					<!--first post-->
					<div id="post">
						<div>
							<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
						</div>
						<div>
							<div style="font-weight: bold; color: #b1424d;">User One</div>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet leo sollicitudin, 
							pretium libero eget, tincidunt tellus. Nam nec elit ipsum. Suspendisse malesuada cursus 
							nulla non rhoncus. Aliquam eget porttitor nunc, a facilisis odio. Nullam in libero tellus.
							Sed justo diam, vestibulum non lacinia sed, eleifend in diam. In finibus, diam eu congue dapibus, 
							leo dui lacinia purus, non feugiat augue massa at purus. Vestibulum non ornare diam.
							<br><br>
							<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">Jun 6 2021</span>
						</div>
					</div>
					<br><br>
					<!--second post-->
					<div id="post">
						<div>
							<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
						</div>
						<div>
							<div style="font-weight: bold; color: #b1424d;">User Two</div>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet leo sollicitudin, 
							pretium libero eget, tincidunt tellus. Nam nec elit ipsum. Suspendisse malesuada cursus 
							nulla non rhoncus. Aliquam eget porttitor nunc, a facilisis odio. Nullam in libero tellus.
							Sed justo diam, vestibulum non lacinia sed, eleifend in diam. In finibus, diam eu congue dapibus, 
							leo dui lacinia purus, non feugiat augue massa at purus. Vestibulum non ornare diam.
							<br><br>
							<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">Jun 6 2021</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>