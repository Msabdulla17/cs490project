<?php
    include('functions.php');

    if(isset($_GET['like_type']) && isset($_GET['post_id']))
    {
        if (is_numeric($_GET['post_id']))
        {
            if ($_GET['like_type'] == 'post')
            {
                header("location: ".$_SERVER['HTTP_REFERER']);
                like_post($_GET['post_id'], $_GET['like_type']);
            }
        }
    }
    die;
?>

