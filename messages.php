<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
	$profile_data = $user_data;
    $error = "";

    if (isset($_GET['user_id']))
    {
        $profile_id = $_GET['user_id'];
    }

 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
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
	<div style="display: flex;">
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<div> 
					<form style= "width: 100%;" method= "post">
						<hr>
							<?php
								if($error != "")
								{
									array_push($errors, "Error.");
									header("timeline.php");
								}
                                else
                                {
                                    if (isset($_GET['type']) && $_GET['type'] == "new")
                                    {
                                        echo "Compose a new message";
                                        if (isset($_GET['user_id']))
                                        {
                                            $ROW_USER = getUserById($profile_id);
                                            var_dump($ROW_USER);
                                        }
                                        else
                                        {
                                            echo "That user could not be found.<br><br>";
                                        }
                                    }
                                    else
                                    {
                                        echo "Messages<br><br>";
                                        $ROW_USER = getUserById($user_id);
                                        include("message.php");
                                    }  
								}
							?>
						<hr>
						<input type ="hidden" name="post_id" value=<?php echo $post_id ?>>
						<input id="delete_button" type="submit" name="delete_btn" value="Delete">
						<br>
					</form>
                <br style="clear: both;">
				</div>
			</div>
		</div>
	</div>
</body>
</html>