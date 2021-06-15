<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	$profile_data = $user_data;

	$ROW2 = false;
    if (isset($_GET['id']))
    {
        $post_id = $_GET['id'];
        $ROW2 = get_post($post_id);

		if (!$ROW)
		{
			array_push($errors, "No post was found.");
		}
		else
		{
			if($ROW['users_id'] != $user_id)
			{
				array_push($errors, "Access Denied.");
			}
		}
    }
    else
    {
        array_push($errors, "No post was found.");
    }

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		header("location: index.php");
		delete_post($post_id);
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Post</title>
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
				<div> 
					<form style= "width: 100%;" method= "post">
						<hr>
							<?php
								echo display_error();
								if($ROW2)
								{
									if($ROW2['users_id'] == $user_id)
									{
										echo "Are you sure you want to delete this post?<br>";
										foreach ($ROW2 as $ROW)
										{
											$ROW_USER = getUserById($ROW['users_id']);
											include("post_delete.php");
										}
										echo "<input type ='hidden' name='post_id' value=<'$post_id'>";
										echo "<input id='delete_button' type='submit' name='delete_btn' value='Delete'>";
									}
									else
									{
										array_push($errors, "Access Denied.");  
									}
								}
								else
								{
									array_push($errors, "No post was found.");
									header("index.php");
								}
							?>
						<hr>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>