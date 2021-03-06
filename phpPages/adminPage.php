<?php
require_once '../phpScripts/admin_functions.php';
require_once '../phpScripts/globals.php';

// INIT USERS TO DISPPLAY
$users = fetchUsers($DB_CREDENTIALS);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us</title>
  <!-- JQ -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Bulma Version 0.9.0-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" type="text/css" href="../resources/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../resources/css/voterscompanion.css" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>

  <!-- Bulma Responsive Tables -->
  <link rel="stylesheet" href="%SOME-LOCAL-PATH%/bulma-responsive-tables/css/main.min.css">

  <style type="text/css">
    h1.title,
    h3.subtitle {
      text-align: center;
    }

    h1.title {
      font-weight: 900;
    }

    .is-main h1.title {
      font-size: 3rem;
    }

    .is-main h3.subtitle {
      font-size: 2rem;
    }

    footer.footer .logo img {
      max-height: 30px;
      width: auto;
    }
  </style>

</head>

<body>
  <?php

  require_once 'footer-header/header.php';

  ?>

  <!-- Welcome Message -->
  <section class="hero is-light is-main">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered" style='color: white;'>
          Welcome Admin!
        </h1>
        <P class='subtitle has-text-centered' style='color: white;'>Here are our current users, admins and editors!</h3>
  </section>

  <!-- TABLE -->
  <section class='section'>
    <div class='container'>
      <div class='b-table'>
        <div class='table-wrapper has-mobile-cards'>
          <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Update Role</th>
                <th>Date Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php
              if (!(empty($users))) {
                displayUsers($users);
              }
              ?>
</body>


<script src="../resources/js/admin.js"></script>

<script>
  //confirm delete function
  function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
  }

  //show roles function
  function showRoles(obj) {
    var div = document.getElementById(obj);
    if (div.style.display == 'none') {
      div.style.display = '';
    } else {
      div.style.display = 'none';
    }
  }
</script>

</html>