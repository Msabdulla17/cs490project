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

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        var_dump($_POST);
        var_dump($_FILES);
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
	    <div style="display: flex; padding: 20px; background-color: white;">
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<div> 
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
                                echo "Compose a New Message<br><br>";
                                if (isset($_GET['user_id']))
                                {
                                    $FRIEND_ROW = getUserById($profile_id);
                                    include "user.php";
                                    echo "<br><br><br><div style= 'border:solid thin #aaa; padding: 10px; background-color: white;'>
                                    <form style='width: 100%' method='post' enctype='multipart/form-data'>
                                    <textarea name='message' placeholder='Send a message'></textarea>
                                    <input type='file' name='file'>
                                    <input id='post_button' type='submit' value='Send'>
                                    <br></form></div>";
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
                    <br style="clear: both;">
				</div>
			</div>
		</div>
	</div>
</body>
</html>