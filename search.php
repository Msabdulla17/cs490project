<?php
    include("functions.php");

    if (!isLoggedIn()) 
	{
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
    if (isset($_GET['find']))
    {
        $find = addslashes($_GET['find']);
        
        $query = "SELECT * FROM user_list WHERE first_name LIKE '%$find%' 
        OR last_name LIKE '%$find%'";
        $result = mysqli_query($db, $query);
    }
    else
    {

    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Search</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <!-- notification message -->
	<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
	<?php endif ?>

</body>
</html>