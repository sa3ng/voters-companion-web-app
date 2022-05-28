<?php
require_once '../phpScripts/globals.php';
require_once '../phpScripts/candidates_page_functions.php';

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
    displayCandidates($DB_CREDENTIALS);
    ?>

  </div>




  </div>

</body>

</html>