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
  require '../phpScripts/globals.php';
  require '../phpScripts/forum_processor.php';


  //Temporaray upload
  //Declaring variables
  $acc_id = 1;                      // Get key from current session cookie
  $header = $_POST["title-input"];
  $message = $_POST["message-input"];
  $is_reply = 0;

  //Upload to Database
  if($header != NULL)
    uploadPost($DB_CREDENTIALS, $acc_id, $_POST["title-input"], $_POST["message-input"], $is_reply);


  //Initialize functions
  $post_headers = fetchHeaders($DB_CREDENTIALS);
  //$post_id
  //$post_messages

  


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


  <div class="search-bar box content media">
    <input class="search-bar input is-primary column is-half is-offset-one-quarter" type="text" placeholder="Search Forum">
    <p class="image is-48x48 ">
      <img src="https://preview.pixlr.com/images/800wm/100/1/1001451331.jpg">
    </p>
  </div>

  <a class="button  box is-medium is-primary column is-4 is-offset-4" href='ForumCreatePost.php'>Create a Post</a>

  <div class="column is-10 is-offset-1">
    <div class="box content">

      <?php

      $num_of_posts = 1;
      foreach ($post_headers as $headers) {

        echo "
        <a href='ForumPostPage.php'>
        <article class='post'>
          <h4>" . $headers . "</h4>
          <div class='media'>
            <div class='media-left'>
              <p class='image is-32x32'>
                <img src='http://bulma.io/images/placeholders/128x128.png'>
              </p>
            </div>
            <div class='media-content'>
              <div class='content'>
                <p>
                  <a href='#'>@jsmith</a> posted 34 minutes ago 
                  <span class='tag'>Question</span>
                </p>
              </div>
            </div>
            <div class='media-right'>
              <span class='post-icons has-text-grey-light'><i class='fa-solid fa-thumbs-up'></i> 1</span>
              <span class='post-icons has-text-grey-light'><i class='fa fa-comments'></i> 1</span>
            </div>
          </div>
        </article>
        </a>
        ";
        $num_of_posts += 1;
      }

      ?>

    </div>
  </div>
  </div>

</body>

</html>