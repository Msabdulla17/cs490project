<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
 		</div>
	</div>
	<!-- Main Body -->
	<div style="width: 800px; margin: auto; min-height: 400px;">
		<!-- Cover photo and profile picture -->
		<div style="background-color: white; text-align: center; color: #b1424d">
			<img src="images/cover_photo.png" style="width:100%;">
			<img id="profile_picture" src="images/user_profile.png">
			<br>
			<?php  if (isset($_SESSION['user'])) : ?>
				<div style="font-size: 20px;">
					<?php echo $_SESSION['user']['username']; ?>
				</div>
				<small>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
				</small>
				<?php endif ?>
			<br>
			<div id="menu_buttons">Feed</div>
			<div id="menu_buttons">About</div>
			<div id="menu_buttons">Friends</div>
			<div id="menu_buttons">Photos</div>
			<div id="menu_buttons">Settings</div> 
		</div>
		<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
			<!--friends--> 
			<div style= "text-align: center;background-color: white; min-height: 400px; flex: 1;">
				<div id="friends_bar>
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
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2;">
				
				<!--make a post--> 
				<div style= "width: 100%; border:solid thin #aaa; padding: 10px; background-color: white;">
					<textarea placeholder="Make a post here."></textarea>
					<input id="post_button" type="submit" name="post_button" value="Post">
					<br>
				</div>

				<!--feed area-->
				<div id="post_bar">
					<div style= "font-weight: bold; color: #b1424d; float:left;">Posts</div>
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
							<br>
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
							<br>
							<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">Jun 6 2021</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="text-align: center;">
		<?php  if (isset($_SESSION['user'])) : ?>
			<small>
				<a href="index.php?logout='1'" style="color: red;">Log Out</a>
			</small>
		<?php endif ?>
	</div>
</body>
</html>