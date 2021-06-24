<?php 
	include('functions.php');
	if (!isLoggedIn())
 	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
	if (!isAdmin()) 
	{
		$_SESSION['msg'] = "You must be an admin to see this page.";
		header('location: index.php');
		exit();
	}

	$all_users = get_all_users();

	if (isset($_POST['delete_btn'])) 
	{
		header("location: ".$_SERVER['HTTP_REFERER']);
		delete_user($_POST['selected_user']);
	}
	$user_data = getUserById($user_id);
	$bar_image = "images/user_profile.png";
	if (file_exists($user_data['profile_image']))
	{
		$bar_image = $user_data['profile_image'];
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete User</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<style>
		button[name=delete_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<!-- top bar -->
	<form style="width:100%; background-color: #b1424d;" method = "get" action="search.php">	
		<div id="top_bar">
			<div style="width: 800px; height: 40px; margin:auto; font-size: 30px;">
				<a href="timeline.php" style="color: white";>Artstagram</a>
				&nbsp &nbsp 
				<input type="text" name="find" id="search_box" placeholder="Search">
				<a href ="index.php?id=<?php echo $user_id?>">
					<img src="<?php echo $bar_image ?>" style="max-height: 50px; float: right;">
				</a>
				<?php  if (isset($_SESSION['user'])) : ?>
					<a href="index.php?logout='1'" style="font-size: 11px; float: right; margin: 10px; color: white;">
					Log Out
					</a>		
				<?php endif ?>
			</div>
		</div>
	</form>
	<div class="header">
		<h2>Delete User</h2>
	</div>
	<form method="post" action="delete_user.php">
		<?php echo display_error(); ?>
		<div class="input-group">	
			<select name="selected_user">
				<option disabled selected>-- Select User --</option>
				<?php
					foreach($all_users as $user)
					{	
						echo "<option value='". $user['id'] ."'>" .$user['first_name'] . ' ' .$user['last_name'] ."</option>";
					}
				?>
			</select>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="delete_btn"> - Delete user</button>
		</div>
	</form>
</body>
</html>
