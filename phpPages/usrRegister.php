<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- JQUERY 3.6 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="../resources/js/register.js"></script>

  <!-- CSS FILE -->
  <link rel="stylesheet" href="../resources/css/style.css">
  <link rel="stylesheet" href="../resources/css/voterscompanion.css">
</head>

<?php

require_once 'footer-header/header.php';

?>

<body>
  <section class="hero register-hero is-fullheight">
    <section class="section is-large">
      <div class="container">
        <div class="columns">
          <div class="column is-10 is-offset-1">
            <div class="columns register-boxes">
              <!-- Sign Up Texts -->
              <div class="column mr-3 mb-5">
                <h1 class="title is-1 has-text-left has-text-black">
                  <span>Sign-Up!</span>
                </h1>
                <hr class="hr register-hr">
                <h1 class="subtitle is-3 has-text-left has-text-black"><span>Welcome to Voter's
                    Companion!
                  </span><span></span></h1>
                <script src="https://unpkg.com/typewriter-effect@2.3.1/dist/core.js"></script>
                <h1 class="subtitle is-4 has-text-left has-text-black"><span>A Platform for your
                    Political
                  </span><span id="typing"></span></h1>

                <p class="subtitle">
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis ex deleniti
                  aliquam tempora libero excepturi vero soluta odio optio sed.
                </p>
              </div>
              <!-- Sign Up Form -->
              <div class="column">
                <form id="register-form" action="../phpScripts/register.php" method="POST">
                  <h1 class="title">Enter your details here</h1>
                  <div class="field">
                    <div class="control">
                      <input id="email-register" name="email-register" class="input is-size-5 register-input" required type="email" placeholder="[EMAIL NEXT TIME]">
                    </div>
                    <p id="error-email" class='hidden has-text-danger-dark'>Email has already been registered</p>
                  </div>
                  <div class="field">
                    <input id="user-register" name="user-register" class="input is-size-5 register-input" required type="text" placeholder="Username">
                  </div>
                  <p id="error-user" class='hidden has-text-danger-dark'>Name has already been registered</p>

                  <div class="field">
                    <input id="pass-register" name="pass-register" class="input is-size-5 register-input" required type="password" placeholder="Password">
                  </div>
                  <p name=error-pass class='hidden has-text-danger-dark'>Error: Passwords don't match</p>

                  <div class="field">
                    <input id="re-pass-register" name="re-pass-register" class="input is-size-5 register-input" required type="password" placeholder="Re-enter Password">
                  </div>
                  <p name="error-pass" class='hidden has-text-danger-dark'>Error: Passwords don't match</p>

                  <div class="field is-grouped is-grouped-centered">
                    <input id="register-submits" class="button" type="submit">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</body>

<!-- 
    JS ANIMATION
 -->
<script>
  var app = document.getElementById('typing');

  var typewriter = new Typewriter(app, {
    loop: "true"
  });

  var stringarr = ["<strong>Opinions</strong>", "<strong>Words</strong>", "<strong>Expressions</strong>"];


  function repeat(typewriter, string) {
    typewriter.typeString(string)
      .pauseFor(1500)
      .deleteAll()
      .start();
  }

  stringarr.forEach(element => {
    repeat(typewriter, element);
  });
</script>

</html>