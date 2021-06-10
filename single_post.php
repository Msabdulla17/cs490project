<?php
    include ('functions.php');

	if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}

    $ROW2 = false;
    if (isset($_GET['post_id']))
    {
        $post_id = $_GET['post_id'];
        $ROW2 = get_post($post_id);
    }
    else
    {
        array_push($errors, "No post was found.");
    }

    if (isset($_GET['users_id'])) 
	{
		$profile_data = getUserById($_GET['users_id']);
	}
	else
	{
		$profile_data = $user_data;
	}

    if (isset($_POST['post_btn'])) 
	{
		$result = create_post();
        var_dump($_POST['parent']);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Single Post | Artstagram</title>
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
		<!--post that you want to view--> 
		<div style= "background-color: white; min-height: 400px;">
			<br>
			<div id="single_post_bar">
                <div style= "color: #b1424d;">Comment</div>
                <br>
                <?php
                    foreach ($ROW2 as $ROW)
                    {
                        $ROW_USER = getUserById($ROW['users_id']);
                        include('post.php');
                    }
                ?>
                <br style="clear: both;">

                <div style= "width: 100%; min-height: 90px; border:solid thin #aaa; background-color: white;">
					<form style= "width: 80%;" method ="post">
						<textarea name="post" placeholder="Post a comment here."></textarea>
						<input type="hidden" id="parent" name="parent" value=$post_id>
                        <input id="post_button" type="submit" class="btn" name="post_btn" value="Post">
						<br>
					</form>
				</div>
                
                <?php
                   
                   $comments = get_comments();

                   if (is_array($comments))
                   {
                       foreach ($comments as $COMMENT)
                       {
                           include('comment.php');
                       }
                   }
                ?>

            </div>
            <br>
		</div>
	</div>

</body>
</html>