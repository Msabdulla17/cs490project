<?php

    echo "<pre";
    echo ($_GET);
    echo "<pre";

    if(isset($_GET['like_type']) && isset($_GET['post_id']))
    {
        if (is_numeric($_GET['id']))
        {
           $allowed[] = 'post';
           $allowed[] = 'user';
           $allowed[] = 'comment';

            if (in_array($_GET['type'], $allowed))
            {
                like_post($_GET['post_id'], $_GET['type']);
            }
        }
    }
    die;
?>

