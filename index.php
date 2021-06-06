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
	<link rel="stylesheet" type="text/css" href="style.css">
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
			<img id="profile_picture" src="images/user_profile.png">
			<br>
			<?php  if (isset($_SESSION['user'])) : ?>
				<strong>
					<?php echo $_SESSION['user']['username']; ?>
				</strong>
				<small>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
				</small>
				<?php endif ?>
			<br>
			<div>
				About
			</div>
			<div>
				Friends
			</div>
			<div>
				Photos	
			</div>
			<div>
				Settings
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