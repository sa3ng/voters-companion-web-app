<?php
require '../phpScripts/globals.php';
require '../phpScripts/candidates_page_processor.php';

$candidate_names = fetchCandidates($DB_CREDENTIALS);


?>


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


  <style>
    .hovereffect:hover {
      transform: translate3D(0, -1px, 0) scale(1.02);
      transition: 0.3s;
    }

    .logo {
      height: fit-content;
      width: 100%;
    }

    .navbar {
      height: min-content;

    }
  </style>
</head>

<body>
  <section class="hero is-info">
    <div class="hero-body">
      <p class="title" style="text-align: center;">
        <em>Candidates</em>
      </p>
      <p class="subtitle" style="text-align: center;">
        <em>Running for President</em>
      </p>
  </section>

  <br><br>

  <div class="container">

    <?php
    $num_of_candidates = 1;

    foreach ($candidate_names as $names) {

      if (!($num_of_candidates % 2 == 0) || $num_of_candidates == 1) {
        echo "
                <div class='columns'>
                <div class='column'>
                 <div class='card hovereffect'>
                   <div class='card-content'>
                     <div class='media'>
                     <div class='media-left'>
                     <figure class='image is-128x128'>
                       <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                     </figure>
                   </div>
                   <div class='media-content'>
                   "
          . "<p class ='title'>" . $candidate_names[$num_of_candidates - 1] . "</p>" .
          "
                     <p class='subtitle'>
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                     </p>
                     </div>
                   </div>
                   <footer class='card-footer'>
                     <p class='card-footer-item'>
                       <span>
                        <a href='CandidatePage.html'>Learn More</a>
                       </span>
                     </p>
                   </footer>
                   </div>
                 </div>
                 </div>
                 ";
      } else {
        echo "
                <div class='column'>
                 <div class='card hovereffect'>
                   <div class='card-content'>
                     <div class='media'>
                     <div class='media-left'>
                     <figure class='image is-128x128'>
                       <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                     </figure>
                   </div>
                   <div class='media-content'>
                   "
          . "<p class ='title'>" . $candidate_names[$num_of_candidates - 1] . "</p>" .
          "
                     <p class='subtitle'>
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                     </p>
                     </div>
                   </div>
                   <footer class='card-footer'>
                     <p class='card-footer-item'>
                       <span>
                        <a href='CandidatePage.html'>Learn More</a>
                       </span>
                     </p>
                   </footer>
                   </div>
                 </div>
                 </div>
                 </div> 
                 ";
      };


      $num_of_candidates += 1;
    }
    ?>


  </div>




  </div>

</body>

</html>