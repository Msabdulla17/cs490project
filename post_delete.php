
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
		<span style="color: #999;">
            <?php echo $ROW['timestamp']; ?>
        </span>
    </div>
</div>