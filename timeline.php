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
			Artstagram &nbsp &nbsp
			<input type="text" id="search_box" placeholder="Search">
			<img src="images/user_profile.png" style="width: 40px; float: right;">
 		</div>
	</div>
	<!-- Main Body -->
	<div style="width: 800px; margin: auto; min-height: 400px;">
		<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
			<!--friends--> 
			<div style= "color:#b1424d; min-height: 400px; flex: 1;">
				<div id="timeline_bar">
                    <img src="images/user_profile.png" id="profile_picture_timeline">
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
				</div>
			</div>
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<!--make a post--> 
				<div style= "width: 100%; min-height: 90px; border:solid thin #aaa; background-color: white;">
					<form style= "width: 80%;" action="timeline.php" method ="post">
						<textarea name="post" placeholder="Make a post here."></textarea>
						<input id="post_button" type="submit" class="btn" name="post_btn" value="Post">
						<br>
					</form>
				</div>

				<!--feed area w/ recent posts-->
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
	<div style="text-align: center;">
		<?php  if (isset($_SESSION['user'])) : ?>
			<small>
				<a href="index.php?logout='1'" style="color: red;">Log Out</a>
			</small>
		<?php endif ?>
	</div>
</body>
</html>