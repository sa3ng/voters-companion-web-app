<?php
require '../phpScripts/login_processor.php';

// 0 by default. Variable is used to check for the query status of the queryAccount function.
$query_return = 0;
if (array_key_exists("REQUEST_METHOD", $_SERVER)) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (checkConnection($DB_CREDENTIALS)) {
      $query_return = queryAccount(
        $DB_CREDENTIALS,
        // array with POST login credentials
        [
          "email" => $_POST["email-input"],
          "pass" => $_POST["pass-input"]
        ]
      );
    }
  }
}
?>

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

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> -->
</head>



<style>
</style>

<section class="hero is-link">
  <div class="hero-body">
    <p class="title" style="text-align: center;">
      Voters' Companion
    </p>
    <p class="subtitle" style="text-align: center;">
      <em>Your one stop shop for voting and candidate information!</em>
    </p>
  </div>
</section>


<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="Home.html">
      <img src="../resources/images/VC-logo" width="112" height="25">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="Home.html">
        Home
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="Candidates.php">
          Candidates
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            Presidential
          </a>
          <a class="navbar-item">
            Vice Presidential
          </a>
          <a class="navbar-item">
            Senatorial
          </a>

        </div>
      </div>

      <a class="navbar-item" href="ForumPage.html">
        Forums
      </a>


      <a class="navbar-item" href="AboutUs.html">
        About Us
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-link" href="usrRegister.php">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="index.php">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

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
            <form method="POST">
              <div class="field">
                <div class="control">
                  <input required <?php
                                  // changes input color if invalid
                                  if ($query_return == -1) {
                                    echo "class='input is-danger is-large'";
                                  } else {
                                    echo "class='input is-large'";
                                  }

                                  // changes placeholder text to last input if invalid
                                  if (array_key_exists("email-input", $_POST)) {
                                    echo "placeholder=" . $_POST["email-input"];
                                  } else {
                                    echo "placeholder='Your Email'";
                                  }
                                  ?> name="email-input" type="text" autofocus="">
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <input required <?php
                                  // changes input color if invalid
                                  if ($query_return == -2) {
                                    echo "class='input is-danger is-large'";
                                  } else {
                                    echo "class='input is-large'";
                                  }

                                  // changes placeholder text to last input if invalid
                                  if (array_key_exists("pass-input", $_POST)) {
                                    echo "placeholder=" . str_repeat("*", strlen($_POST["pass-input"]));
                                  } else {
                                    echo "placeholder='Your Password'";
                                  } ?> name="pass-input" type="password">
                </div>
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