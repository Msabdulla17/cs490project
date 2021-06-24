<div id="message_thread" style="background-color: #eee">
	<div>
        <?php
            $thumb_image = "images/user_profile.png";
            if (file_exists($message_owner['profile_image']))
            {
                $thumb_image = $message_owner['profile_image'];
            }
        ?>
		<img src="<?php echo $thumb_image ?>" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            echo "<a href='index.php?id=$message_owner[id]'>"; 
            echo $message_owner["first_name"];
            echo " ";
            echo $message_owner["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $single_thread['message']; ?>
        <?php  if (file_exists($single_thread['file'])) : ?>
            <img src = "<?php echo $single_thread['file'] ?>" style="width:200px;">
        <?php endif ?>
        <br><br>
		<span style="color: #b1424d;">
            <?php echo ($single_thread['date']); ?>
        </span>
	</div>
</div>
<br><br>