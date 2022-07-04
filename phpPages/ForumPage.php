<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voters' Companion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="../resources/css/voterscompanion.css">


  <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>

  <style>
    .has-bg-img {
      background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAa8AAAB1CAMAAADOZ57OAAAANlBMVEUAdP4EMv4ELP4Ad/4ELf4BY/4CW/4BXv4BYP4DWf4DV/4DVf4DTv4BXP4DUv4DUP4BZf4DS/5B5NwOAAACFElEQVR4nO3VCU4DMRBEUU8cAtkI3P+yBAgiyWy2R5qukv4/gaWnaqduQZtjTrRuS7gOcK0eXF7B5RVcXrVy7eEKiXV5xbq8gssruLyCyyu4vKrm2sEVGevyinV5BZdXcHkFl1dweVXOdYZLINblFVxecQy9gssruLyCy6sCrle4dGJdXsHlFcfQK7i8gssruLya4nqDSy7W5RVcXnEMvYLLK7i8gssruLyCyyu4vILLqx7XC1zKPXFtWZd2rMsruLx6OIZwyQeXVxxDr+DyimPoFVxecQydyol1GZV3CS6f8nmTOIY2Xbm6q9fmAy6HvrmuXlu4LPrh6hJcHv1ydYm/y6IbVxf9Dirqjwsvi/LuxoWXQ/9ceBl0x4WXfvdceMmX93dceKn3sC681Hviwku7x2OIl3g9LryU63PhJdwAF1665UOfCy/ZBrnwUm3oGOIl2/C68BJtjAsvyUa58FJsnAsvwfJxlAsvvaa48JJr4hjipdfkuvBSa4YLL63muPCSapYLL6XmufASqoALL51KuPCSqYgLL5XyewkXXiIVcuGlUSkXXhIVc+GlUDkXXgJVcOEVXw0XXuHlSwUXXtHVceEVXCUXXrHVcuEVWjUXXpHVc+EVWAMXXnHlUz0XXmHl07aeC6+omtaFV1SNXHjF1HYM8QqqmQuviNq58ApoARde67eEC6/VW8SF19rlzyVc3RceLRWbBjPEzQAAAABJRU5ErkJggg==')center center;
      background-size: cover;
    }
  </style>
  <?php

  require_once 'footer-header/header.php';
  require_once '../phpScripts/globals.php';
  require '../phpScripts/forum_processor.php';


  // //Temporaray upload
  // //Declaring variables

  // $acc_id = 1;                      // Get key from current session cookie
  // $header = $_POST["title-input"];
  // $message = $_POST["message-input"];
  // $is_reply = 0;

  // //Upload to Database
  // if($header != NULL)
  //   uploadPost($DB_CREDENTIALS, $acc_id, $_POST["title-input"], $_POST["message-input"], $is_reply);


  //$post_id
  //$post_messagess


  
  //Initialize functions
  $post_headers = fetchHeaders($DB_CREDENTIALS);
  $post_likes = fetchLikes($DB_CREDENTIALS);
  $post_acc_ids = fetchPostAccID($DB_CREDENTIALS);
  $post_dates = fetchDates($DB_CREDENTIALS, 1);

  //Pending Posts - Users
  $posts_pending_headers = fetchPendingPosts($DB_CREDENTIALS, 'header');
  $posts_pending_dates = fetchPendingPosts($DB_CREDENTIALS, 'date');

  //For-approval posts - Editors
  $posts_not_approved = fetchNonApprovedPosts($DB_CREDENTIALS, 'header');
  $posts_not_app_dates = fetchNonApprovedPosts($DB_CREDENTIALS, 'date');

  $post_acc_type = fetchAccTBL($DB_CREDENTIALS, 'type');

  

  ?>
</head>

<style>
  .post {
    border-bottom-style: solid;
    border-color: rgb(235, 231, 231);
    margin-bottom: 10px;
    padding-bottom: 7px;
  }

  .post-icons {
    padding-right: 10px;
  }

  .button-to-link {
    background: none;
    border: none;
    padding: 0;

    /*input has OS specific font-family*/
    color: #069;
    cursor: pointer;
  }


  .transparent {
        cursor: pointer;
        border: 1px solid white;
        background-color: transparent;
        color: white;

  }

  .hidden{
      display: none;
  }
</style>

<!-- Font Awesome  -->
<script src="https://kit.fontawesome.com/29800fcb6c.js" crossorigin="anonymous"></script>


<body>

  <section class="hero is-info">
    <div class="hero-body">
      <p class="title" style="text-align: center;">
        <em>Forum</em>
      </p>
      <p class="subtitle" style="text-align: center;">
        <em>Remember to be Respectful!</em>
      </p>
  </section>


  <!-- <div class="search-bar box content media">
    <input class="search-bar input is-primary column is-half is-offset-one-quarter" type="text" placeholder="Search Forum">
    <p class="image is-48x48 ">
      <img src="https://preview.pixlr.com/images/800wm/100/1/1001451331.jpg">
    </p>
  </div> -->
  <br>
  <br>

  <a class="button  box is-medium is-primary column is-4 is-offset-4" href='ForumCreatePost.php'>Create a Post</a>

    <?php
    if(strcmp($post_acc_type,"editor") == 0){

      echo "<div class='column is-10 is-offset-1'>
      <div class='content'><h2>For Approval:</h2></div>
      <div class='box content mb-6'>";

      $index = 0;
      foreach($posts_not_approved as $posts){
        echo "
        <form action='ForumPostPage.php' method='POST'>
        <input type='hidden' value='$posts' name='post_header'>
        <article class='post' id='editorTestDiv'>
              <button class='transparent' type='submit'><h3>".$posts."</h3></button>
              <div class='media'>
                <div class='media-left'>
                  <p class='image is-32x32'>
                    <img src='http://bulma.io/images/placeholders/128x128.png'>
                  </p>
                </div>
                <div class='media-content'>
                  <div class='content'>
                    <p> 
                      posted on $posts_not_app_dates[$index]
                      <span class='tag'>Question</span>
                    </p>
                  </div>
                </div>
                <div class='media-right'>
                  <button class='button is-success' formaction='../phpScripts/approve_post.php' type='submit'><i class='fa-solid fa-check'></i>&nbsp; Approve</button>
                  <button class='button is-danger' type='submit' formaction='../phpScripts/delete_post.php'><i class='fa-solid fa-trash'></i>&nbsp; Reject</button>
                </div>
              </div>
            </article>
            </form>
            
        ";
        $index += 1;
        }

    }

    else{
      $index = 0;
      echo "<div class='column is-10 is-offset-1'>
      <div class='content'><h2>My Pending Posts</h2></div>
      <div class='box content mb-6'>";

      foreach($posts_pending_headers as $pending_headers){

        echo "

        <form action='ForumPostPage.php' method='POST'>
        <input type='hidden' value='$pending_headers' name='post_header'>
        <article class='post'>
              <button class='transparent' type='submit'><h3>".$pending_headers."</h3></button>
              <div class='media'>
                <div class='media-left'>
                  <p class='image is-32x32'>
                    <img src='http://bulma.io/images/placeholders/128x128.png'>
                  </p>
                </div>
                <div class='media-content'>
                  <div class='content'>
                    <p>
                      posted on $posts_pending_dates[$index]
                      <span class='tag'>Question</span>
                    </p>
                  </div>
                </div>
                <div class='media-right'>
                  <button class='button is-danger' formaction='../phpScripts/delete_post.php' type='submit'><i class='fa-solid fa-xmark'></i>&nbsp; Cancel</button>
                </div>
              </div>
            </article>
            </form>";
          $index += 1;
      } 
    }

    



        
        ?>
<!-- 
        <script>
            function showEditorDiv() {
            var x = document.getElementById("editorTestDiv");
            if (x.style.display === "none") 
                x.style.display = "block";
             else 
                x.style.display = "none";
            
            }
        </script> -->

    </div>

    <div class="column is-7 ">
      <div class="content"><h2>Active Posts</h2></div>
    </div>
    
    <div class="box content">

      <?php

      $num_of_posts = 0;
      $index = 0;
      foreach ($post_headers as $headers) {
        $user_tag_array = fetchTags($DB_CREDENTIALS, $post_acc_ids, $num_of_posts);

        echo "
      
        <form action='ForumPostPage.php' method='POST'>
        <article class='post'>
        <input type='hidden' name='post_header' value= '" . $headers. "'></input>
        <input type='hidden' name='post_user' value= '" .$user_tag_array[0]. "'></input>
        <input type='hidden' name='post_likes' value= '" .$post_likes[$num_of_posts]. "'></input>
        <input type='hidden' name='post_date' value= '" .$post_dates[$num_of_posts]. "'></input>
          <button class='transparent' type='submit'><h3> " . $headers . "</h3> </button>
          <div class='media'>
            <div class='media-left'>
              <p class='image is-32x32'>
                <img src='http://bulma.io/images/placeholders/128x128.png'>
              </p>
            </div>
            <div class='media-content'>
              <div class='content'>
                <p>
                  <button formaction='usrPage.php' class='button-to-link' type='submit'>" . $user_tag_array[0] . "</button> posted on $post_dates[$num_of_posts]
                  <span class='tag'>Question</span>
                </p>
              </div>
            </div>
            <div class='media-right'>";

            if(strcmp($post_acc_type,"editor") == 0){
              echo"<button class='button is-danger' formaction='../phpScripts/delete_post.php' type='submit'><i class='fa-solid fa-xmark'></i>&nbsp; Remove</button>";
            }
            

          echo 
            "
            </div>
          </div>
        </article>
        </form>
        ";
        $num_of_posts += 1;
      }

      ?>

    </div>
  </div>
  </div>

</body>

</html>