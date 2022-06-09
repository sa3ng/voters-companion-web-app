<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About Us</title>
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/voterscompanion.css" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>

    <!-- Bulma Responsive Tables -->
    <link rel="stylesheet" href="%SOME-LOCAL-PATH%/bulma-responsive-tables/css/main.min.css">

    <style type="text/css">
    h1.title, h3.subtitle {
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

          <tr>
            <td data-label='ID'>1</td>
            <td data-label='Username'>user123</td>
            <td data-label='Role'>Admin</td>
            <td data-label='UpdateRole'>
                <div class="buttons are-small">
                <button class="button is-info is-light">User</button>
                <button class="button is-warning is-light">Editor</button>
                <button class="button is-danger is-light">Admin</button>
                </div>
            </td>
            <td data-label="Created">
              <small class="has-text-grey is-abbr-like">June 9, 2022</small>
            </td>

            <!-- BUTTONS FOR VIEW AND DELETE (can remove view button not 100% necessary) -->
            <td class="is-actions-cell">
              <div class="buttons is-right">
                <button class="button is-small is-primary" type='button'>
                  <span class="icon"><i class="fa fa-eye"></i></span>
                </button>
                <button class='button is-small is-danger jb-modal' data-target='sample-modal' type='button' onclick='ConfirmDelete()'>
                <i class="fa fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          
    <!-- Some Sample Data (can delete later) -->
        <tr>
            <td data-label="ID">2</td>
            <td data-label="Username">ryanrenolds22</td>
            <td data-label="Role">Editor</td>
            <td data-label='UpdateRole'>
                <div class="buttons are-small">
                <button class="button is-info is-light">User</button>
                <button class="button is-warning is-light">Editor</button>
                <button class="button is-danger is-light">Admin</button>
                </div>
            </td>
            <td data-label="Created">
              <small class="has-text-grey is-abbr-like">June 9, 2022</small>
            </td>

            <td class="is-actions-cell">
              <div class="buttons is-right">
                <button class="button is-small is-primary" type='button'>
                  <span class="icon"><i class="fa fa-eye"></i></span>
                </button>
                <button class='button is-small is-danger jb-modal' data-target='sample-modal' type='button' onclick='ConfirmDelete()'>
                <i class="fa fa-trash"></i>
                </button>
              </div>
            </td>
        </tr>

        <tr>
            <td data-label="ID">3</td>
            <td data-label="Username">GO_BBM5ever</td>
            <td data-label="Role">User</td>
            <td data-label='UpdateRole'>
                <div class="buttons are-small">
                <button class="button is-info is-light">User</button>
                <button class="button is-warning is-light">Editor</button>
                <button class="button is-danger is-light">Admin</button>
                </div>
            </td>
            <td data-label="Created">
              <small class="has-text-grey is-abbr-like">June 9, 2022</small>
            </td>

            <td class="is-actions-cell">
              <div class="buttons is-right">
                <button class="button is-small is-primary" type='button'>
                  <span class="icon"><i class="fa fa-eye"></i></span>
                </button>
                <button class='button is-small is-danger jb-modal' data-target='sample-modal' type='button' onclick='ConfirmDelete()'>
                <i class="fa fa-trash"></i>
                </button>
              </div>
            </td>
        </tr>
  </body>

 
  <script>
//confirm delete function
  function ConfirmDelete()
    {
     return confirm("Are you sure you want to delete?");
    }

//show roles function
  function showRoles(obj)
    {
    var div = document.getElementById(obj);
    if (div.style.display == 'none')
    {
        div.style.display = '';
    }
    else
    {
        div.style.display = 'none';
    }
    }
</script>
</html>