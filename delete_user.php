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
		delete_user($_POST['selected_user']);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete User</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<style>
		.header {
			background: #003366;
		}
		button[name=delete_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
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
