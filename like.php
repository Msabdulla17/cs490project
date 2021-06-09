<?php
    if(isset($_SERVER['HTTP_REFERER']))
    {
        $return_to = $_SERVER['HTTP_REFERER'];
    }
    else
    {
        $return_to = "index.php";
    }
    if(isset($_GET['type']) && isset($_GET['id']))
    {
        if (is_numeric($_GET['id']))
        {
           $allowed[] = 'post';
           $allowed[] = 'user';
           $allowed[] = 'comment';

            if (in_array($_GET['type'], $allowed))
            {
                like_post($_GET['id'], $_GET['type'], $user_id);
            }
        }
    }
    header("location: " . $return_to);
    die;
?>

