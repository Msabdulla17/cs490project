<div id="friends">
	<a href="index.php?id=<?php echo $FRIEND_ROW['id'];?>">
		<?php
            $thumb_image = "images/user_profile.png";
            if (file_exists($FRIEND_ROW['profile_image']))
            {
                $thumb_image = $FRIEND_ROW['profile_image'];
            }
        ?>
		<img id="friends_img" src="<?php echo $thumb_image ?>">
		<br>
		<?php 
        	echo $FRIEND_ROW["first_name"] . " " . $FRIEND_ROW["last_name"]; 
    	?>
	</a>
</div>