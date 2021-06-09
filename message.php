<div id="post" style="background-color: #eee;">
  <div>
    <?php
      $image = "user_profile.png";
      if(file_exists($ROW_USER['profile_image']))
      {
        $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
      }
    ?>
    <img src="<?php echo ROOT . $image ?>" style="width: 75px;margin-right:4px;border-radius: 50%;">
  </div>
  <div style="width: 100%;">
    <div style="font-weight: bold;color: #405d9b;width: 100%;">
      <?php
         echo "<a href='".ROOT."profile/$COMMENT[userid]'>";
         echo html.specialchars($ROW_USER['first_name'])."".htmlspecialchars($ROW_USER['last_name']);
         echo "</a>";
         if($COMMENT['is_profile_image'])
         {
           $pronoun="they";
           echo "<span style='font weight:normal;color:#aaa;'> updated $pronoun profile image</span>";
         }
         if($COMMENT['is_cover_image'])
         {
           $pronoun="they";
           echo "<span style='font weight:normal;color:#aaa;'> updated $pronoun cover image</span>";
         }
      ?>
   </div>
   <?php echo check_tags($COMMENT['post']) ?>
     <br><br>
     <?php
       if(file_exists($COMMENT['image'])
       {
         $post_image = ROOT . $image_class->get_thumb_post($COMMENT['image']);
         echo "<img src='$post_image' style='width:80%;' />";
       }
    ?>
    </br></br>
  <?php
          $likes = "";
          $likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ;
   ?>
<a href="<?=ROOT?>like/post/<?php echo $COMMENT['postid'] ?>">Likes<?ph echo $likes ?></a>.
</div>
</div>
