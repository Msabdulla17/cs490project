<?php
  include('functions.php');
	if(!empty($_GET['search']))
	{
		$url = 'https://api.unsplash.com/search/photos?query='+$_GET['search']+'&client_id=D0zuSiTKvrj8GHZG91rRLSNLu20jmitBUDeS2D1EQCg&per_page=50';
	}
	$user_data = getUserById($user_id);
	$bar_image = "images/user_profile.png";
	if (file_exists($user_data['profile_image']))
	{
		$bar_image = $user_data['profile_image'];
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
			<div style="width: 800px; height: 40px; margin:auto; font-size: 30px;">
				<a href="timeline.php" style="color: white";>Artstagram</a>
				&nbsp &nbsp 
				<input type="text" name="find" id="search_box" placeholder="Search">
				<a href ="index.php?id=<?php echo $user_id?>">
					<img src="<?php echo $bar_image ?>" style="max-height: 50px; float: right;">
				</a>
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
		<br>
		<div style="text-align: center; color:#b1424d;">
			<h2> Have art block?</h2>
			<h4> Try the Unsplash API Photo Search</h4>
			<br>
		</div>
		<div style="text-align: center; display:block;">
			<form id="myForm" autocomplete="off" style="width: 60%; display:inline-block; margin-right:auto; margin-left:auto">
				<div class="form-group">
					<input type="text" class="form-control" id="search" placeholder="Search for inspiration" required>
				</div>
				<br>
				<div class="form-group">
					<button class="btn btn-danger btn-block" style="background-color:#b1424d;">
						Search Images
					</button>
				</div>
			</form>
		</div>
		<br>
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
					<hr>
					<br>
					<h2 class="name" style="text-align:center;">${photo.user.name}</h2>
					<h3 class="link" style="text-align:center;">
					<a href="${photo.user.links.html}">Unsplash Profile: ${photo.user.username}</a>
					</h3>
					<img style="display:block; margin-right:auto; margin-left:auto; width: 60%;" src="${photo.urls.regular}"/>
					<br>
					`)
				});
  			}
  		})
  	})
</script>
</html>
