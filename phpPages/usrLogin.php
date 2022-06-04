<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../resources/css/style.css">
  <link rel="stylesheet" href="../resources/css/voterscompanion.css">

  <!-- JQUERY 3.6 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="../resources/js/usr_login.js"></script>
  <!-- Depecrafted Style sheet lnk for Bulma via jsdelvr CDN -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> -->
</head>



<style>
</style>

<?php

require_once 'footer-header/header.php';

?>

<body>
  <section class="hero is-fullheight is-login">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="scale-in-center column is-4 is-offset-4">
          <h3 class="title has-text-black">Welcome!</h3>
          <hr class="login-hr has-background-black">
          <p class="subtitle has-text-black">Login here to access more features.</p>
          <div class="box">
            <!-- LOGO HERE -->
            <figure class="avatar image is-128x128 mx-auto mb-5">
              <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
            </figure>
            <?php
            // Code section underneath dictates that the form should submit to itself
            ?>
            <form action="../phpScripts/login_processor.php" method="POST">
              <div class="field">
                <div class="control">
                  <input required class='input is-large' name="email-input" placeholder='Your Email' type="email" autofocus="">
                </div>
                <p class="has-text-left has-text-danger hidden" id="email-error">ERROR: INVALID EMAIL</p>
              </div>

              <div class="field">
                <div class="control">
                  <input required class='input is-large' name="pass-input" type="password" placeholder='Your Password'>
                </div>
                <p class="has-text-left has-text-danger hidden" id="pass-error">ERROR: INVALID PASSWORD</p>
              </div>
              <div class="field">
                <label class="checkbox">
                  <input name="remember-check" type="checkbox">
                  Remember me
                </label>
              </div>
              <button type="submit" class="button is-block is-info is-large is-fullwidth">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
            </form>
          </div>
          <p class="has-text-grey">
            <a class="button" href="../">Sign Up</a>
            <a class="button" href="../">Forgot Password</a>
          </p>
        </div>
      </div>
    </div>
  </section>
</body>

</html>