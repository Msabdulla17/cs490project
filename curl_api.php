
<?php
	include('functions.php');
    if(!empty($_GET['search']){
	    $url = 'https://api.unsplash.com/search/photos?query='+$_GET['search']+'&client_id=D0zuSiTKvrj8GHZG91rRLSNLu20jmitBUDeS2D1EQCg&per_page=50'
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
