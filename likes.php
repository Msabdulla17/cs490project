<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
	$likes = false;
    if (isset($_GET['post_id']) && isset($_GET['like_type']))
    {
        $post_id = $_GET['post_id'];
        $post_type = $_GET['like_type'];
        $likes = get_likes($post_id,$post_type);
    }
    else
    {
        array_push($errors, "No data was found.");
    }

 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Who Post</title>
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
						<hr>
							<?php
                                if(is_array($likes))
                                {
                                    foreach ($likes as $ROW)
                                    {
                                        foreach($ROW as $item)
                                        {
                                            var_dump($item);
                                        }
                                        $FRIEND_ROW = getUserByID($user_id);
                                        include("user.php");
                                    }
                                }
							?>
						<br>
                <br style="clear: both;">
				</div>
			</div>
		</div>
	</div>
</body>
</html>