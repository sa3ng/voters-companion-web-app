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
        <form id="candidate-modal-form" action="../phpScripts/test.php" method="POST">

          <div class="field">
            <label class="label">Candidate Name</label>
            <div class="control">
              <input name="c-cand-name" class="input" type="text" placeholder="Candidate Name">
            </div>
          </div>

          <div class="field">
            <label class="label">Candidate Number</label>
            <div class="control">
              <input name="c-cand-num" class="input" type="number" placeholder="Candidate Number">
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
    displayCandidates($DB_CREDENTIALS);
    ?>

  </div>




  </div>

</body>
<script src="../resources/js/candidates.js"></script>

</html>