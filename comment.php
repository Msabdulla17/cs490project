<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            echo "<a href='index.php?id=$COMMENT[users_id]'>"; 
            echo $ROW_USER["first_name"];
            echo " ";
            echo $ROW_USER["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $COMMENT['post']; ?>
        <br><br>
		<a href="like.php?like_type=post&post_id=<?php echo $COMMENT['post_id']?>">Like(<?php echo $COMMENT['likes']?>)</a> . 
        <a href="single_post.php?post_id=<?php echo $COMMENT['post_id'] ?>">Comment</a> . 
        <span style="color: #999;">
            <?php echo $COMMENT['timestamp']; ?>
        </span>
	</div>
</div>
<br><br>