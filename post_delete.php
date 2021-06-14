<?php 
    if (!isLoggedIn()) 
    {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
?>
<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            echo "<a href='index.php?id=$ROW[users_id]'>"; 
            echo $ROW_USER["first_name"];
            echo " ";
            echo $ROW_USER["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $ROW['post']; ?>
        <br><br>
        <?php
            $likes = "";
            $likes = ($ROW['likes'] > 0) ? " (". $ROW['likes'] . ")": "";
        ?> 
		<a href="like.php?like_type=post&post_id=<?php echo $ROW['post_id']?>">Like<?php echo $likes?></a> . 
        <a href="single_post.php?post_id=<?php echo $ROW['post_id'] ?>">Comment</a> . 
        <span style="color: #999;">
            <?php echo $ROW['timestamp']; ?>
        </span>
        <span>
       
        </span>
    </div>  
</div>
<br>