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
            $num_likes = "";
            $num_likes = ($ROW['likes'] > 0) ? " (". $ROW['likes'] . ")": "";
        ?> 
		<a href="like.php?like_type=post&post_id=<?php echo $ROW['post_id']?>">Like<?php echo $num_likes?></a> . 
        <a href="single_post.php?post_id=<?php echo $ROW['post_id'] ?>">Comment</a> . 
        <span style="color: #999;">
            <?php echo $ROW['timestamp']; ?>
        </span>
        <span style="color: #999; float:right">
            <?php
                if(is_my_post($ROW['post_id']))
                {
                    echo "
                    <a href='edit.php'>
                        Edit 
                    </a>
                    . 
                    <a href='delete.php?id=$ROW[post_id]'>
                        Delete 
                    </a>";
                }
            ?>
        </span>
        <?php        
             $likes_minus_one = ($ROW['likes'] - 1);
            if ($ROW['likes'] > 0)
            {
                echo "<br><br>";
                echo "<a href='likes.php?like_type=post&post_id=$ROW[post_id]'>";
                if ($ROW['likes'] == 1)
                {
                    if ($i_liked($ROW['post_id']))
                    {
                        echo "<div style = 'text-align: left;'>You like this post </div>"; 
                    }
                    else
                    {
                        echo "<div style = 'text-align: left;'>1 person likes this post </div>"; 
                    }
                }
                if ($ROW['likes'] > 1)
                {
                    if ($i_liked($ROW['post_id']))
                    {
                        if ($likes_minus_one == 1)
                        {
                            echo "<div style = 'text-align: left;'>You and 1 other person like this post </div>";
                        }
                        else
                        {
                            echo "<div style = 'text-align: left;'>You and " . $ROW['likes'] . " other people like this post </div>"; 
                        }
                    } 
                    else
                    {
                        echo "<div style = 'text-align: left;'>" . $ROW['likes'] . " people like this post </div>"; 
                    }
                }
                echo "<a>";
            }
        ?>
    </div>  
</div>
<br>