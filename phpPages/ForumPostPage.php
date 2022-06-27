<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voters' Companion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="../resources/css/voterscompanion.css">
    <?php

    require_once 'footer-header/header.php';
    require_once '../phpScripts/globals.php';
    require '../phpScripts/forum_processor.php';

    //initialize variables
    $post_header = $_POST['post_header'];


    if(isset($_POST['post_user'])){
      $post_user = $_POST['post_user'];
      $post_likes = $_POST['post_likes'];
    }
    else{
      $post_user = '';
    }
      
    $post_message = fetchPostInfo($DB_CREDENTIALS, 'message', $post_header);
    $post_id = fetchPostInfo($DB_CREDENTIALS,'post_id', $post_header);
    
    //replies
    $reply_messages = fetchReplyElement($DB_CREDENTIALS, $post_id, 'message');


  
    ?>
  </head>

  <style>
    .post, .reply{
      border-bottom-style: solid;
      border-color: rgb(235, 231, 231);
      margin-bottom: 10px;
      padding-bottom: 7px;

    }
    
    .specific-post{
      border-bottom-style: solid;
      border-color: rgb(235, 231, 231);
      margin-bottom: 10px;
      padding-bottom: 7px;
    }

    .post-icons{
      padding-right: 10px;
    }
  </style>

  <!-- Font Awesome  -->
<script src="https://kit.fontawesome.com/29800fcb6c.js" crossorigin="anonymous"></script>


  <body>
    <div class="column is-10 is-offset-1">
      <div class="box content">
        
        <article class="specific-post">
          <?php

            echo "<h4 class='post_header'>".$post_header."</h4>
                  <p class = 'post-message'>".$post_message ."</p>

                  <div class='media'>
            <div class='media-left'>
              <p class='image is-32x32'>
                <img src='http://bulma.io/images/placeholders/128x128.png'>
              </p>
            </div>
            <div class='media-content'>
              <div class='content'>
                <p>
                  <a href='#'>".$post_user. "</a> posted 34 minutes ago 
                  <span class='tag'>Question</span>
                </p>
              </div>
            </div>
            <div class='media-right'>
              <span class='post-icons has-text-grey-light'><i class='fa-solid fa-thumbs-up'></i> 1</span>
            </div>
          </div>
            ";

          ?>
         
        </article>

        <?php
        echo "<article class='reply column is-offset-1'>";

        foreach($reply_messages as $replies){
        echo " <p class = 'reply'>".$replies."</p>
        <div class='media'>
          <div class='media-left'>
            <p class='image is-32x32'>
              <img src='http://bulma.io/images/placeholders/128x128.png'>
            </p>
          </div>
          <div class='media-content'>
            <div class='content'>
              <p>
                <a href='#'>@red</a> replied 40 minutes ago 
                <span class='tag'>Reply</span>
              </p>
            </div>
          </div>
          <div class='media-right'>
            <span class='post-icons has-text-grey-light'><i class='fa-solid fa-thumbs-up'></i> 1</span>
          </div>
        </div>
      </article>";

      }
        

        ?>

        <?php

        if(strcmp($post_user, '') != 0){
        echo "
        <article class='reply column is-offset-1'>
        <form action='../phpScripts/upload.php'  method='POST'>
          <input type= 'hidden' name='is_reply' value='1'> 
          
          <input type='hidden' name='post_id' value='".$post_id."'>
         
          <div class='message-input-div media'>
            <textarea class='textarea is-medium is-hovered' name='message-input' placeholder='Express yourself...'></textarea>
          </div>
          <div class='media'>
            <div class='media-content'>
              (1000 Characters max)
            </div>
            <div class='media-right'>
            <button class='button' name='post' type='submit'><strong> Post </strong></button>
            </div>
          </div>
        </form>
        </article>
        ";
        }


        ?>
      </div>
    </div>
    </div>
  </body>
</html>