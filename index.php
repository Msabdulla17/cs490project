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
	<!-- Cover photo and profile picture -->
	<div style="width: 800px; margin: auto; background-color: black; min-height: 400px;">
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
			<br><br>
			<div id="menu_buttons">Feed</div>
			<div id="menu_buttons">About</div>
			<div id="menu_buttons">Friends</div>
			<div id="menu_buttons">Photos</div>
			<div id="menu_buttons">Settings</div> 
		</div>
	<!-- feed below cover photo and profile picture -->
		<div style="display: flex;">
				
			<!--friends--> 
			<div style= "min-height: 400px; flex:1"></div>
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

			<!--posts--> 
			<div style= "min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
				<div style= "border:solid thin #aaa; padding: 10px; background-color: white;">
					<textarea placeholder="Make a post here."></textarea>
					<input id="post_button" type="submit" name="post_button" value="Post">
					<br>
				</div>
			</div>
		</div>
	</div>
		
		<div>
			<?php  if (isset($_SESSION['user'])) : ?>
				<small>
					<a href="index.php?logout='1'" style="color: red;">Log Out</a>
				</small>
			<?php endif ?>
		</div>
</body>
</html>