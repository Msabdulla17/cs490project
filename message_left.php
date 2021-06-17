<div id="message_left" style="background-color: #eee">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            $message_owner = getUserById($msg_row['sender']);
            echo "<a href='index.php?id=$msg_row[sender]'>"; 
            echo $message_owner["first_name"];
            echo " ";
            echo $message_owner["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $msg_row['message']; ?>
        <br><br>
		<span style="color: #b1424d;">
            <?php echo ($msg_row['date']); ?>
        </span>
	</div>
</div>
<br><br>