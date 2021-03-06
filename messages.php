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
        $profile_data = getUserById($_GET['user_id']);
        $profile_id = $_GET['user_id'];
    }
    $user_data = getUserById($user_id);
    $thumb_image = "images/user_profile.png";
	if (file_exists($profile_data['profile_image']))
	{
		$thumb_image = $profile_data['profile_image'];
	}
    $bar_image = "images/user_profile.png";
	if (file_exists($user_data['profile_image']))
	{
		$bar_image = $user_data['profile_image'];
	}
    if (isset($_GET['type']) && $_GET['type'] == "new")
    {
        $thread = read_message($profile_id);
        foreach ($thread as $old_thread)
        {
            if (is_array($old_thread))
            {
                header("location: messages.php?type=read&user_id=" . $profile_id);
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if (is_array(getUserById($profile_id)))
        {
            send_message($_POST,$_FILES, $profile_id);
            header("location: messages.php?type=read&user_id=" . $profile_id);
        }
        else
        {
            array_push($errors, "No user found.");
        }
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
                            if (isset($_GET['type']) && $_GET['type'] == "read")
                            {
                                echo "Chatting with ";
                                if (isset($_GET['user_id']))
                                {
                                    $data = read_message($profile_id);
                                    $FRIEND_ROW = getUserById($profile_id);
                                    include "user.php";
                                    echo "<br><br><br>";
                                    echo'<div>';
                                        foreach ($data as $msg_row)
                                        {
                                            if(i_own($msg_row))
                                            {
                                                include ('message_right.php');
                                            }
                                            else
                                            {
                                                include ('message_left.php');
                                            }
                                        }
                                    echo'</div>';

                                    echo "<br><br><br><div style= 'padding: 10px; background-color: white;'>
                                    <form style='width: auto' method='post' enctype='multipart/form-data'>
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
                            elseif (isset($_GET['type']) && $_GET['type'] == "new")
                            {
                                echo "Compose a New Message<br><br>";
                                if (isset($_GET['user_id']))
                                {
                                    $FRIEND_ROW = getUserById($profile_id);
                                    include "user.php";
                                    echo "<br><br><br><div style= 'border:solid thin #aaa; padding: 10px; background-color: white;'>
                                    <form style='width: auto' method='post' enctype='multipart/form-data'>
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
                                $all_threads = read_threads();
                                if (is_object($all_threads))
                                {
                                    foreach ($all_threads as $single_thread)
                                    {
                                        $my_id  = ($single_thread['sender'] == $user_id) ? $single_thread['receiver'] : $single_thread['sender'];
                                        $message_owner = getUserById($my_id);
                                        include("thread.php");
                                    }
                                }
                                else
                                {
                                    echo "You have no messages.";
                                }
                                echo "<br style='clear:both;'>";
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