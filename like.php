<?php
    
    if(isset($_SERVER['HTTP_REFERER']))
    {
       $return_to = $_SERVER['HTTP_REFERER'];
    }
    else
    {
       $return_to = "index.php";
    }

    if(isset($_GET['like_type']) && isset($_GET['post_id']))
    {
        if (is_numeric($_GET['post_id']))
        {
           $allowed[] = 'post';
           $allowed[] = 'user';
           $allowed[] = 'comment';

            if (in_array($_GET['like_type'], $allowed))
            {
                like_post($_GET['post_id'], $_GET['type']);
            }
        }
    }
    header("location: " . $return_to);
    die;
?>

