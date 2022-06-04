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
          <h4>Bulma: How do you center a button in a box?</h4>
          <p class = "post-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore molestiae unde eveniet excepturi accusantium assumenda adipisci alias, quia, magnam aliquid ea repellat nemo provident, minima rerum deleniti officiis aut repellendus.</p>
          <div class="media">
            <div class="media-left">
              <p class="image is-32x32">
                <img src="http://bulma.io/images/placeholders/128x128.png">
              </p>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <a href="#">@adamson</a> posted 34 minutes ago 
                  <span class="tag">Question</span>
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="post-icons has-text-grey-light"><i class="fa-solid fa-thumbs-up"></i> 1</span>
              <span class="post-icons has-text-grey-light"><i class="fa fa-comments"></i> 1</span>
            </div>
          </div>
        </article>

        <article class="reply column is-offset-1">
          <h4>You are stupid....</h4>
          <p class = "reply">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore molestiae unde eveniet excepturi accusantium assumenda adipisci alias, quia, magnam aliquid ea repellat nemo provident, minima rerum deleniti officiis aut repellendus.</p>
          <div class="media">
            <div class="media-left">
              <p class="image is-32x32">
                <img src="http://bulma.io/images/placeholders/128x128.png">
              </p>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <a href="#">@red</a> replied 40 minutes ago 
                  <span class="tag">Question</span>
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="post-icons has-text-grey-light"><i class="fa-solid fa-thumbs-up"></i> 1</span>
            </div>
          </div>
        </article>
        <article class="reply column is-offset-1">
          <h4>Yes I am....</h4>
          <p class = "reply">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore molestiae unde eveniet excepturi accusantium assumenda adipisci alias, quia, magnam aliquid ea repellat nemo provident, minima rerum deleniti officiis aut repellendus.</p>
          <div class="media">
            <div class="media-left">
              <p class="image is-32x32">
                <img src="http://bulma.io/images/placeholders/128x128.png">
              </p>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <a href="#">@red</a> replied 40 minutes ago 
                  <span class="tag">Question</span>
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="post-icons has-text-grey-light"><i class="fa-solid fa-thumbs-up"></i> 1</span>
            </div>
          </div>
        </article>
      </div>
    </div>
    </div>
  </body>
</html>