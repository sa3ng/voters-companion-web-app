<?php
require_once '../phpScripts/globals.php';
require_once '../phpScripts/candidates_page_functions.php';

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Voters' Companion</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css'>
  <link rel='stylesheet' href='../resources/css/voterscompanion.css'>

  <!-- jQuery CDN -->
  <script src='https://code.jquery.com/jquery-3.6.0.min.js' integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>

  <?php

  require_once 'footer-header/header.php';

  ?>

  <!-- ?INTERNAL STYLING? -->
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
  getHeader($_GET['pos_id']);
  ?>

  <br><br>
  <!-- BUTTONS FOR CRUD -->
  <?php
  if (isEditor()) {
    echo
    "
      <div class='container'>
      <button class='js-modal-trigger button is-success' data-target='modal-js-add'>
        Add Candidate
      </button>
      <button class='js-modal-trigger button is-danger' data-target='modal-js-delete''>
        Delete Candidate
      </button>
      </div>

    ";
  }
  ?>
  <br><br>

  <!-- MODAL FOR ADDING -->
  <div id='modal-js-add' class='modal'>
    <div class='modal-background'></div>

    <div class='modal-content'>
      <div class='box'>
        <form id='candidate-modal-form' action='../phpScripts/candidate_create_validation.php' method='POST'>

          <div class='field'>
            <label class='label'>Candidate Name</label>
            <div class='control'>
              <input name='c-cand-name' class='input' type='text' required placeholder='Candidate Name'>
            </div>
          </div>

          <div class='field'>
            <label class='label'>Candidate Number</label>
            <div class='control'>
              <input name='c-cand-num' class='input' type='number' required placeholder='Candidate Number' min='1'>
            </div>
          </div>

          <div class='select is-primary'>
            <select name='c-cand-pos'>
              <option value='P'>President</option>
              <option value='VP'>Vice President</option>
              <option value='S'>Senator</option>
            </select>
          </div>

          <div class='field'>
            <label class='label'>Description</label>
            <div class='control'>
              <textarea name='c-cand-desc' class='textarea' placeholder='Description'></textarea>
            </div>
          </div>

          <div class='field is-grouped'>
            <div class='control'>
              <input type='submit' class='button is-link' value='Submit'>
            </div>
          </div>

        </form>
      </div>
    </div>

    <button class='modal-close is-large' aria-label='close'></button>
  </div>

  <!-- MODAL FOR EDIT -->
  <div id='modal-js-edit' class='modal'>
    <div class='modal-background'></div>

    <div class='modal-content'>
      <div class='box'>
        <form id='candidate-edit-modal-form' action="../phpScripts/candidate_overview_edit.php">

          <div class='field'>
            <label class='label'>Candidate Name</label>
            <div class='control'>
              <input name='e-cand-name' class='input' type='text' required placeholder='Candidate Name'>
            </div>
          </div>

          <div class='field'>
            <label class='label'>Description</label>
            <div class='control'>
              <textarea name='e-cand-desc' class='textarea' placeholder='Description'></textarea>
            </div>
          </div>

          <div class='field'>
            <div class='control'>
              <input name='e-cand-num' class='input' type='hidden' required placeholder='Candidate Number' min='1'>
            </div>
          </div>

          <div class='field is-grouped'>
            <div class='control'>
              <input type='submit' class='button is-link' value='Submit'>
            </div>
          </div>

        </form>
      </div>
    </div>

    <button class='modal-close is-large' aria-label='close'></button>
  </div>

  <!-- MODAL FOR DELETING -->
  <div id="modal-js-delete" class="modal">
    <div class="modal-background"></div>

    <div class="modal-content">
      <div class="box">
        <p>Choose a Candidate to Delete</p><br>

        <!-- Candidate Card -->
        <div class='card'>
          <header class='card-header'>
            <p class='card-header-title'>
              Candidate Name Here
            </p>
          </header>
          <div class='card-content'>
            <div class='content'>
              Candidate Number # 15
            </div>
          </div>
          <footer class='class-footer'>
            <a href='#' class='card-footer-item' onclick='ConfirmDelete()'>Delete</a>
          </footer>
        </div>

        <br>

        <div class='card'>
          <header class='card-header'>
            <p class='card-header-title'>
              Candidate Name Here
            </p>
          </header>
          <div class='card-content'>
            <div class='content'>
              Candidate Number # 15
            </div>
          </div>
          <footer class='class-footer'>
            <a href='#' class='card-footer-item' onclick='ConfirmDelete()'>Delete</a>
          </footer>
        </div>
      </div>

    </div>
  </div>

  <button class="modal-close is-large" aria-label="close"></button>
  </div>

  <div class='container'>

    <?php
    displayCandidates($DB_CREDENTIALS, $_GET['pos_id']);
    ?>

  </div>




  </div>

</body>
<script>
  function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
  }
</script>
<script src="../resources/ckeditor/build/ckeditor.js"></script>
<script src='../resources/js/candidates.js'></script>
<script src='../resources/js/ckeditors.js'></script>

</html>