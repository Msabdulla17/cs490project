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
	<link rel="stylesheet" href="style.css">
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
	
	<div id="top_bar">
		<div style="width: 800px;margin:auto;font-size: 30px;">
			Artstagram &nbsp &nbsp
			<input type="text" id="search_box" placeholder="Search">
			<img src="images/user_profile.png" style="width: 40px; float: right;">
 		</div>
	</div>
	
	<div style="width: 800px; margin: auto; background-color: black; min-height: 400px;">
		<div style="background-color: white; text-align: center; color: #b1424d">
			<img src="images/cover_photo.png" style="width:100%;">
			<img class="profile_picture" src="images/user_profile.png">
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
			<div id="menu_buttons">About</div>
			<div id="menu_buttons">Friends</div>
			<div id="menu_buttons">Photos</div>
			<div id="menu_buttons">Settings</div> 
		</div>
		
		<div style="display: flex;">
			<div style= "min-height: 400px; flex:1"></div>
			<div style= "min-height: 400px; flex:2.5;"></div>
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