<div id="message_thread" style="background-color: #eee; position:relative;">
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
        <?php echo "Click to view your thred."; ?>
        <br><br>
		<span style="color: #b1424d;">
            <?php echo ($single_thread['date']); ?>
        </span>
        <a href="messages.php?type=read&user_id=<?php echo $message_owner['id']?>">
            <div style="cursor: pointer; background-color:#b1424d; height:100%; width:50px; position:absolute; right:10px; top:4px;">
                <svg style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%)" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M24 23h-24v-13.275l2-1.455v-7.27h20v7.272l2 1.453v13.275zm-20-10.472v-9.528h16v9.527l-8 5.473-8-5.472zm14-.528h-12v-1h12v1zm0-3v1h-12v-1h12zm-7-1h-5v-3h5v3zm7 0h-6v-1h6v1zm0-2h-6v-1h6v1z"/>
                </svg>
            </div>
        </a>
	</div>
</div>
<br><br>