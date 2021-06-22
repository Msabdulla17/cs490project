<?php 
	include('functions.php');

	if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	if (isset($_POST['change_btn'])) 
	{
        if (isset ($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            print_r(($_FILES['file']['name']));
            $filename = "uploads/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
            
            if (file_exists($filename))
            {
                $query = "UPDATE user_list SET profile_image = '$filename'
                        WHERE user_id = '$user_id' LIMIT 1";
                save($query);
            }
        }
        else
        {
            echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
            echo "<br>The following error(s) occured:<br><br>";
            echo "Invalid image.";
            echo "</div>";
        }

	}

	if (isset($_GET['id'])) 
	{
		$profile_data = getUserById($_GET['id']);
	}
	else
	{
		$profile_data = $user_data;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Change Profile Picture</title>
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
	<form style="width:100%; background-color: #b1424d;" method = "get" action="search.php">	
		<div id="top_bar">
			<div style="width: 800px; height: 50px; margin:auto; font-size: 30px;">
				<a href="timeline.php" style="color: white";>Artstagram</a>
				&nbsp &nbsp 
				<input type="text" name="find" id="search_box" placeholder="Search">
				<a href ="index.php"><img src="images/user_profile.png" style="width: 40px; float: right;"></a>
				<?php  if (isset($_SESSION['user'])) : ?>
					<a href="index.php?logout='1'" style="font-size: 11px; float: right; margin: 10px; color: white;">
					Log Out
					</a>		
				<?php endif ?>
			</div>
		</div>
	</form>
	<!-- Main Body -->
	<div style="width: 800px; margin: auto; min-height: 400px;">
		<!-- Cover photo and profile picture -->
		<div style="display: flex;">
			<!-- feed below cover photo and profile picture -->
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<!--make a post--> 
				<form style= "width: 80%;" method ="post" enctype="multipart/form-data">
					<div style= "width: 100%; padding: 10px; border:solid thin #aaa; background-color: white;">	
                        <input type="file" name="file" id="file">
						<input id="change_button" type="submit" class="btn" name="change_btn" value="Submit">
						<br>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>