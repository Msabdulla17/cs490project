<?php
    $message_owner = getUserById($msg_row['sender']);
?>
<div id="message_right" style="background-color: #eee">
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
            echo "<a href='index.php?id=$msg_row[sender]'>"; 
            echo $message_owner["first_name"];
            echo " ";
            echo $message_owner["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $msg_row['message']; ?>
        <?php  if (file_exists($msg_row['file'])) : ?>
            <img src = "<?php echo $msg_row['file'] ?>" style="width:200px;">
        <?php endif ?>
        <br><br>
		<span style="color: #b1424d;">
            <?php echo ($msg_row['date']); ?>
        </span>
	</div>
</div>
<br><br>