<?php
  include('functions.php');
	if(!empty($_GET['search']))
	{
		$url = 'https://api.unsplash.com/search/photos?query='+$_GET['search']+'&client_id=D0zuSiTKvrj8GHZG91rRLSNLu20jmitBUDeS2D1EQCg&per_page=50';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name "viewport" content="width=devicewidth, initial-scale=1.0">
<title>Unsplash API Photo Search</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<!-- top bar -->
	<form style="width:100%; background-color: #b1424d;" method = "get" action="search.php">	
		<div id="top_bar">
			<div style="width: 800px; height: 50px; margin:auto; font-size: 30px;">
				<a href="timeline.php" style="color: white";>Artstagram</a>
				&nbsp &nbsp 
				<input type="text" name="find" id="search_box" placeholder="Search">
				<a href ="index.php"><img src="images/user_profile.png" style="width: 40px; float: right;"></a>
				<?php  if (isset($_SESSION['user'])) : ?>
					<a href="index.php?logout='1'" style="font-size: 11px; float: right; margin: 10px; color: white;">
					Log Out
					</a>		
				<?php endif ?>
			</div>
		</div>
	</form>
	<!-- Api Search -->
	<div class="container">
  	<br><br>
	<h1 style="text-align: center;">Unsplash Artwork Search</h1>
  	<form id="myForm" autocomplete="off">
  		<div class="form-group">
  			<input type="text" class="form-control" id="search" placeholder="Search Images" required>
  		</div>
  		<div class="form-group">
 	 		<button class="btn btn-danger btn-block">
  				Search Images
  			</button>
  		</div>
  	</form>
  	<div id="result"></div>
  	</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$("#myForm").submit(function(event){
  		event.preventDefault()
	  	$("#result").empty()
  		var search = $("#search").val()
  		var url = "https://api.unsplash.com/search/photos?query="+search+"&client_id=D0zuSiTKvrj8GHZG91rRLSNLu20jmitBUDeS2D1EQCg&per_page=50"
  		$.ajax({
  			method:'GET',
  			url:url,
  			success:function(data){
  				console.log(data)
    				data.results.forEach(photo => {
      					$("#result").append(`
      					<h2 class="name">${photo.user.name}</h2>
      					<h3 class="link">
						<a href="${photo.user.links.html}">${photo.user.username}</a>
					</h3>
      					<img src="${photo.urls.regular}"/>
      					`)
    				});
  			}
  		})
  	})
</script>
</html>
