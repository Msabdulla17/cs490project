<div id="post">
	<div>
		<img src="images/user_profile.png" style="width: 75px; margin-right: 4px;">
	</div>
	<div>
	    <div style="font-weight: bold; color: #b1424d;">
            <?php
		    $client = new http\Client;
		$request = new http\Client\Request;

		$request->setRequestUrl('https://instagram47.p.rapidapi.com/post_comments');
		$request->setRequestMethod('GET');
		$request->setQuery(new http\QueryString([
			'postid' => '2435143128484144113'
		]));

	$request->setHeaders([
			'x-rapidapi-key' => 'f57f39d658mshc8cb5b1a871b6e3p1b0d14jsnf0d710d0d955',
			'x-rapidapi-host' => 'instagram47.p.rapidapi.com'
	]);

	$client->enqueue($request)->send();
	$response = $client->getResponse();

	echo $response->getBody();
        	    echo "<a href='index.php?id=$COMMENT[users_id]'>"; 
            	echo $profile_data["first_name"];
            	echo " ";
            	echo $profile_data["last_name"]; 
            	echo "</a>"
            ?>
        </div>
        <?php echo $COMMENT['post']; ?>
        <br><br>
		<a href="like.php?like_type=post&post_id=<?php echo $COMMENT['post_id']?>">Like(<?php echo $COMMENT['likes']?>)</a> . 
        <a href="single_post.php?post_id=<?php echo $COMMENT['post_id'] ?>">Comment</a> . 
        <span style="color: #999;">
            <?php echo $COMMENT['timestamp']; ?>
        </span>
	</div>
</div>
<br><br>
