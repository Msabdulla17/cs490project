<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            echo "<a href='index.php?id=$msg_row[receiver]'>"; 
            echo $FRIEND_ROW["first_name"];
            echo " ";
            echo $FRIEND_ROW["last_name"]; 
            echo "</a>"
            ?>
        </div>
        <?php echo $msg_row['message']; ?>
        <br><br>
		<span style="color: #999;">
            <?php echo $msg_row['date']; ?>
        </span>
	</div>
</div>
<br><br>