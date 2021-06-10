<div id="friends">
	<a href="index.php?id=<?php echo $FRIEND_ROW['id'];?>">
		<img id="friends_img" src="images/user_profile.png">
		<br>
		<?php 
        	echo $FRIEND_ROW["first_name"] . " " . $FRIEND_ROW["last_name"]; 
    	?>
	</a>
</div>