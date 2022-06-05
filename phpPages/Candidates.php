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

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

  <?php
  if (!(array_key_exists("pos_id", $_GET))) {
    header("Location: Candidates.php?pos_id=P", true);
  } else {
    if (($_GET["pos_id"] == "P")) {

      echo "  <section class='hero is-danger'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for President</em>";
      echo "  </p>";
      echo "  </section>";
    } else if ($_GET["pos_id"] == "VP") {

      echo "  <section class='hero is-success'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for VP</em>";
      echo "  </p>";
      echo "  </section>";
    } else if ($_GET["pos_id"] == "S") {

      echo "  <section class='hero is-warning'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for Senator</em>";
      echo "  </p>";
      echo "  </section>";
    }
  }
  ?>

  <br><br>
  <!-- BUTTONS FOR CRUD -->
  <div class="container">
    <button class="js-modal-trigger button is-success" data-target="modal-js-add">
      Add Candidate
    </button>
    <button class="button is-link">
      Edit Candidate
    </button>
    <button class="button is-danger">
      Delete Candidate
    </button>
  </div>
  <br><br>

  <!-- MODAL FOR ADDING -->
  <div id="modal-js-add" class="modal">
    <div class="modal-background"></div>

    <div class="modal-content">
      <div class="box">
        <form id="candidate-modal-form" action="../phpScripts/candidate_create_validation.php" method="POST">

          <div class="field">
            <label class="label">Candidate Name</label>
            <div class="control">
              <input name="c-cand-name" class="input" type="text" required placeholder="Candidate Name">
            </div>
          </div>

          <div class="field">
            <label class="label">Candidate Number</label>
            <div class="control">
              <input name="c-cand-num" class="input" type="number" required placeholder="Candidate Number" min="1" max="1000">
            </div>
          </div>

          <div class="select is-primary">
            <select name="c-cand-pos">
              <option value="P">President</option>
              <option value="VP">Vice President</option>
              <option value="S">Senator</option>
            </select>
          </div>

          <div class="field">
            <label class="label">Description</label>
            <div class="control">
              <textarea name="c-cand-desc" class="textarea" placeholder="Description"></textarea>
            </div>
          </div>

          <div class="field is-grouped">
            <div class="control">
              <input type="submit" class="button is-link" value="Submit">
            </div>
          </div>

        </form>
      </div>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
  </div>

  <div class="container">

    <?php
    displayCandidates($DB_CREDENTIALS, $_GET["pos_id"]);
    ?>

  </div>




  </div>

</body>
<script src="../resources/js/candidates.js"></script>

</html>