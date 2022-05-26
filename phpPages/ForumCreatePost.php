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
  .post,
  .reply {
    border-bottom-style: solid;
    border-color: rgb(235, 231, 231);
    margin-bottom: 10px;
    padding-bottom: 7px;

  }

  .specific-post {
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
  <div class="column is-10 is-offset-1">
    <div class="box content">

      <article class="specific-post">
        <form  method="GET">
          <div class="title-input-div media">
            <h4 class='media-left'>Title:</h4>
            <input class="input is-hovered" name='title' type="text" placeholder="Enter your Title" value="b">
          </div>
          <div class="message-input-div media">
            <textarea class="textarea is-medium is-hovered" name='message-input' placeholder="Express yourself..."></textarea>
          </div>
          <div class="media">
            <div class="media-content">
              (1000 Characters max)
            </div>
            <div class="media-right">
              <a class="button " name='post' type="submit"> <strong> Post </strong></a>
            </div>
          </div>
        </form>
      </article>

    </div>
  </div>
  </div>

  <?php
  //echo  $_GET['title'];
  ?>


</body>


</html>