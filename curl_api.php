
<?php
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		exit();
	}
	$profile_data = $user_data;
    $error = "";

    if (isset($_GET['user_id']))
    {
        $profile_id = $_GET['user_id'];
    }

    if (isset($_GET['type']) && $_GET['type'] == "new")
    {
        $thread = read_message($profile_id);
        foreach ($thread as $old_thread)
        {
            if (is_array($old_thread))
            {
                header("location: messages.php?type=read&user_id=" . $profile_id);
            }
        }
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
  <div class="container">
  <br><br>
  <h1 style="text-align: center;">Unsplash Photo Search</h1>
  <form id="myForm" autocomplete="off">
  <div class="form-group">
  <input type="text" class="form-control" id="search" placeholder="Search Photos">
  </div>
  <div class="form-group">
  <button class="btn btn-danger btn-block">
  Search Photos
  </button>
  </div>
  </form>
  <div id="result"></div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $("#myForm").submit(function(event){
  event.preventDefault()
  var search = $("#search").val()
  var url = "https://api.unsplash.com/search/photos?query="+search+"&client_id=D0zuSiTKvrj8GHZG91rRLSNLu20jmitBUDeS2D1EQCg&per_page=50"
  $.ajax({
  method:'GET',
  url:url,
  success:function(data){
  console.log(data)
    data.results.forEach(photo => {
      $("#result").append('
                          <
                          <img src="${photo.urls.regular}"/>')
    });
  }
  })
  })
</script>
</html>
