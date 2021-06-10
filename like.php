<?php
    
    if(isset($_SERVER['HTTP_REFERER']))
    {
       $return_to = $_SERVER['HTTP_REFERER'];
    }
    else
    {
       $return_to = "index.php";
    }

    like_post($_GET['post_id'], $_GET['like_type']);
    header("location: " . $return_to);
    die;
?>

