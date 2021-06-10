<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php 
            echo $ROW_USER["first_name"];
            echo " ";
            echo $ROW_USER["last_name"]; 
            ?>
        </div>
        <?php echo $ROW['post']; ?>
        <br><br>
		<a href="like.php?like_type=post&post_id=<?php echo $ROW['post_id']?>">Like(<?php echo $ROW['likes']?>)</a> . 
        <a href="single_post.php?post_id=<?php echo $ROW['post_id'] ?>">Comment</a> . 
        <span style="color: #999;">
            <?php echo $ROW['timestamp']; ?>
        </span>
	</div>
</div>
<br><br>