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
        <?php
            $thumb_image = "images/user_profile.png";
            if (file_exists($ROW_USER['profile_image']))
            {
                $thumb_image = $ROW_USER['profile_image'];
            }
        ?>
		<img src="<?php echo $thumb_image ?>" style="width: 75px; margin-right: 4px;">
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
        <?php  if (file_exists($ROW['image'])) : ?>
            <img src = "<?php echo $ROW['image'] ?>" style="width:200px;">
        <?php endif ?>
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
             $i_liked = false;
             $likes_minus_one = ($ROW['likes'] - 1);

             $query = "SELECT likes FROM likes
             WHERE like_type = 'post' && content_id = '$id' LIMIT 1";
             $result = read($query);
             if(is_array($result))
             {
                 $likes = json_decode($result[0]['likes'],true);
                foreach ($likes as $arry)
                 if(in_array($user_id, $array['user_id']))
                 { 
                     $i_liked = true;
                 }
             }
            if ($ROW['likes'] > 0)
            {
                echo "<br><br>";
                echo "<a href='likes.php?like_type=post&post_id=$ROW[post_id]'>";
                if ($ROW['likes'] == 1)
                {
                    if ($i_liked)
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
                    if ($i_liked)
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