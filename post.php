<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php 
            echo $ROW_USER["first_name"] . " " . $ROW_USER["last_name"]; 
            ?>
        </div>
		
        <?php echo $ROW['post']; ?>
        <br><br>
		<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">Jun 6 2021</span>
	</div>
</div>
<br><br>