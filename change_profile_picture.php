<?php 
	include('functions.php');

	if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
    $profile_data = getUserById($user_id);
    $bar_image = "images/user_profile.png";
	if (file_exists($user_data['profile_image']))
	{
		$bar_image = $user_data['profile_image'];
	}
	if (isset($_POST['change_btn'])) 
	{
        if (isset ($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            if($_FILES['file']['type'] == "image/jpeg")
            {
                $allowed_size = (1024 * 1024) * 3;
                if ($_FILES['file']['size'] < $allowed_size)
                {
                    $folder = "uploads/" . $user_id;

                    if (!file_exists($folder))
                    {
                        mkdir($folder, 0777, true);
                    }
                    $filename = $folder . generate_filename(15) . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);
                    $change = "profile";

                    if (isset($_GET['change']))
                    {
                        $change = $_GET['change'];
                    }

                    if (file_exists($filename))
                    {
                        if ($change == "background")
                        {
                            if (file_exists($profile_data['cover_image']))
                            {
                                unlink($profile_data['cover_image']);
                            }
                            $query = "UPDATE user_list SET cover_image = '$filename'
                                WHERE id = '$user_id' LIMIT 1";
                        }
                        else
                        {
                            if (file_exists($profile_data['profile_image']))
                            {
                                unlink($profile_data['profile_image']);
                            }
                            $query = "UPDATE user_list SET profile_image = '$filename'
                                WHERE id = '$user_id' LIMIT 1";
                        }
                        save($query);
                        header('location: index.php');
                    }
                }
                else
                {
                    echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
                    echo "<br>The following error(s) occured:<br><br>";
                    echo "File cannot be larger than 3 MB.";
                    echo "</div>";
                }
            }
            else
            {
                echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
                echo "<br>The following error(s) occured:<br><br>";
                echo "Image must be of type .jpeg or .jpg.";
                echo "</div>";
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

                        <?php
                            $change = "profile";
                            if (isset($_GET['change']) && $_GET['change'] == "background")
                            {
                                $change = "background";
                                echo "<img src='$user_data[cover_image]' style='max-width:500px;'>";
                            }
                            else
                            {
                                echo "<img src='$user_data[profile_image]' style='max-width:500px;'>";
                            }
                        ?>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>