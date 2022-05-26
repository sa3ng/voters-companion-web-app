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
    <script
      src="https://kit.fontawesome.com/2828f7885a.js"
      integrity="sha384-WAsFbnLEQcpCk8lM1UTWesAf5rGTCvb2Y+8LvyjAAcxK1c3s5c0L+SYOgxvc6PWG"
      crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/png" href="favicon.png" />
  </head>

  <body>
    <!-- Begin Preloader -->
    <div class="preloader-wrapper">
      <div class="preloader">
        <img src="img/preloader.gif" alt="" />
      </div>
    </div>
    <!-- End Preloader-->
    <!-- Begin Scroll Up Button -->

    <form action="#home">
      <button id="toTop" title="Go to top">
        <i class="fas fa-angle-up"></i>
      </button>
    </form>
    <!-- End Scroll Up Button -->
    <?php

    require_once 'footer-header/header.php';
  
    ?>
    <!-- Begin Main Content -->
    <div class="main-content">
      <!-- Begin Team Section -->
      <div class="column is-12 about-me">
        <h1 class="title has-text-centered section-title">Hi! We made this website.</h1>
      </div>
      <div class="columns mx-6">
        <div class="column">
          <div class="card">
            <div class="card-image">
              <figure class="image is-1by1">
                <img src="../resources/images/aboutus_images/kyle.jpg" alt="Member Photo">
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">Kyle Aguas</p>
                  <p class="subtitle is-6">Programmer</p>
                </div>
              </div>
              <div class="content">
                Hi, I'm a 2nd year Software Engineering Student enrolled in iACADEMY, I like to dance and play games in my free time.
                <br>
              </div>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image">
              <figure class="image is-1by1">
                <img src="../resources/images/aboutus_images/david.jpg" alt="Member Photo">
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">David Canlas</p>
                  <p class="subtitle is-6">Programmer</p>
                </div>
              </div>
              <div class="content">
                Hey, I'm a 2nd year BSCS Software Engineering Student in iACADEMY, nice to meet ya. I like sleeping, reading, and gaming.
                <br>
              </div>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image">
              <figure class="image is-1by1">
                <img src="../resources/images/aboutus_images/edgar.png" alt="Member Photo">
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">Edgar Cerda</p>
                  <p class="subtitle is-6">Programmer</p>
                </div>
              </div>
              <div class="content">
                Hey there, I'm currently a 2nd year Software Engineering student here in iACADEMY, I hope you guys enjoy our website.
                <br>
              </div>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-image">
              <figure class="image is-1by1">
                <img src="../resources/images/aboutus_images/paulo.jpg" alt="Member Photo">
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">Paulo Evangelista</p>
                  <p class="subtitle is-6">Programmer</p>
                </div>
              </div>
              <div class="content">
                Hello, I'm a 2nd Year college student studying BS Computer Science, Specializing in Software Engineering! Look forward to more improvements to the app as I continue to develop my craft.
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Team Content -->
      <!-- Begin Sources Content-->
      <div class="section-dark cta">
        <div class="container">
          <div
            class="columns is-multiline"
            data-aos="fade-in"
            data-aos-easing="linear"
          >
            <div class="column is-12 about-me">
              <h1 class="title has-text-centered section-title">
                Sources
              </h1>
            </div>
            <div class="column is-10 has-text-centered is-offset-1 px-5">
              <p class="subtitle">
                All the information we have displayed about the candidates have been compiled via web crawlers and are moderated and verified by our editors and admins.
            </div>
          </div>
        </div>
      </div>
      <!-- End Sources Content-->
      
      <!-- Begin Contact Content -->
      <div class="section-light contact" id="contact">
        <div class="container">
          <div
            class="columns is-multiline"
            data-aos="fade-in-up"
            data-aos-easing="linear"
          >
            <div class="column is-12 about-me">
              <h1 class="title has-text-centered section-title">
                Contact Us!
              </h1>
            </div>
            <div class="column is-8 is-offset-2">
              <h2 class="subtitle">
                Feel free to shoot us a message about anything you'd like to bring up with us regarding the website!
              </h2>
              <form
                action="https://formspree.io/email@example.com"
                method="POST"
              >
                <div class="field">
                  <label class="label">Name</label>
                  <div class="control has-icons-left">
                    <input
                      class="input"
                      type="text"
                      placeholder="Ex. John Smith"
                      name="Name"
                    />
                    <span class="icon is-small is-left">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control has-icons-left">
                    <input
                      class="input"
                      type="email"
                      placeholder="Ex. johnsmith@gmail.com"
                      name="Email"
                    />
                    <span class="icon is-small is-left">
                      <i class="fas fa-envelope"></i>
                    </span>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Message</label>
                  <div class="control">
                    <textarea
                      class="textarea"
                      placeholder="Enter message here"
                      name="Message"
                    ></textarea>
                  </div>
                </div>
                <div class="field">
                  <div class="control ">
                    <button class="button submit-button">
                      Submit&nbsp;&nbsp;
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Contact Content -->
    </div>
    <!-- End Main Content -->

    <!-- Begin Footer -->
    <footer class="footer">
      <p>
        <strong class="white">Voter's Companion</strong> by <a href="AboutUs.html">Team Hapon</a>
        As a project for their software engineering class in
        <a href="https://iacademy.edu.ph">iACADEMY</a>.
      </p>
    </footer>
    <!-- End Footer -->

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../resources/js/home.js"></script>
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script>
      AOS.init({
        easing: "ease-out",
        duration: 800,
      });
    </script>
  </body>
</html>