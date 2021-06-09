<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>DMs</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
 <div style="width: 800px; margin: auto; min-height: 400px;">
	<div style="display: flex;">
		<!-- feed below cover photo and profile picture -->
			<!--friends--> 
			<div style= "background-color: white; color:#b1424d; min-height: 400px; flex: 1;">
				<div id="friends_bar">
					Friends
					<br>
					<?php
						if($all_friends)
						{
							foreach ($all_friends as $FRIEND_ROW)
							{
								include('user.php');
							}
						}
					?>

				</div>
			</div>
		{
  "next_cursor": "AB345dkfC",
  "events": [
    { "id": "110", "created_timestamp": "5300", ... },
    { "id": "109", "created_timestamp": "5200", ... },
    { "id": "108", "created_timestamp": "5200", ... },
    { "id": "107", "created_timestamp": "5200", ... },
    { "id": "106", "created_timestamp": "5100", ... },
    { "id": "105", "created_timestamp": "5100", ... },
    ...
  ]
}
		</div>
	</div>
