<?php
    include("functions.php");

    if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

	$thumb_image = "images/user_profile.png";
	if (file_exists($user_data['profile_image']))
	{
		$thumb_image = $user_data['profile_image'];
	}


    if (isset($_GET['find']))
    {
        $find = addslashes($_GET['find']);
        
        $query = "SELECT * FROM user_list 
				WHERE first_name LIKE '%$find%' OR last_name LIKE '%$find%'";
        $result = read($query);
    }
    else
    {
		array_push($errors, "Page not available;");
    }
?>
 <!DOCTYPE html>
<html>
<head>
	<title>Search</title>
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
					<img src="<?php echo $thumb_image ?>" style="max-height: 50px; float: right;">
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
	<div style="display: flex;">
			<!--make a post and recent posts--> 
			<div style= "min-height: 400px; padding: 20px; padding-right: 0px; flex:2.5;">
				<div> 
						<hr>
							<?php
                                if(is_array($result))
                                {
                                    foreach ($result as $ROW)
                                    {
                                        $FRIEND_ROW = $ROW;
                                        include("user.php");
                                    }
                                }
								else
								{
									echo "No results found.";
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