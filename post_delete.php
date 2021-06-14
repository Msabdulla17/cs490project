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
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
            echo $ROW_USER["first_name"];
            echo " ";
            echo $ROW_USER["last_name"]; 
            ?>
        </div>
        <?php echo $ROW['post']; ?>
        <br><br>
		<span style="color: #999;">
            <?php echo $ROW['timestamp']; ?>
        </span>
        <span>
       
        </span>
    </div>  
</div>
<br>