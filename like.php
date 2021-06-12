<?php
    include('functions.php');

    if(isset($_GET['like_type']) && isset($_GET['post_id']))
    {
        if (is_numeric($_GET['post_id']))
        {
            if ($_GET['like_type'] == 'post')
            {
                like_post($_GET['post_id'], $_GET['like_type']);
            }
        }
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
    die;
?>

