<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
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
      <!-- Begin Introduction Content -->
      <div class="section-light about-me" id="about-me">
        <div class="container">
          <div class="column is-12 about-me">
            <h1 class="title has-text-centered section-title">What is this website?</h1>
          </div>
          <div class="columns is-multiline">
            <div
              class="column is-6 has-vertically-aligned-content"
              data-aos="fade-right"
            >
              <p class="is-larger">
                &emsp;&emsp;<strong
                  >Voters' Companion is a website that has the tools you need to go through the elections period smoothly! </strong>
              </p>
              <br />
              <p>
                The website provides you with a list of all the candidates in a particular election, and relevant information about them, to boot, such as a quick description of the candidate, including what position they're running for, what number in the ballot they are. To dive further in, the information is separated into tabs so it could be in more digestible portions, which you can check in the Candidates page of this website!
              </p>
              <br />
            </div>
            <div class="column is-6 right-image " data-aos="fade-left">
              <img
                class="is-rounded"
                src="../resources/images/home_images/vote.jpg"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
      <div class="section-light about-me" id="about-me">
        <div class="container">
            <div class="columns is-multiline">
            <div class="column is-6 left-image " data-aos="fade-right">
                <img
                  class="is-rounded"
                  src="../resources/images/home_images/talk.jpg"
                  alt=""
                />
              </div>
          
          
            <div
              class="column is-6 has-vertically-aligned-content"
              data-aos="fade-left"
            >
              <p class="is-larger">
                &emsp;&emsp;<strong
                  >However, candidate information isn't the only thing we offer.</strong
                >
              </p>
              <br />
              <p>
                Another feature the website consists of is the Forums. This is a place where you can post questions or discussions about the elections you want to have in the form of threads. Although, to be able to participate in these, you must be logged in with an account. Once you are logged in, you are able to create the aforementioned threads, or participate in other threads other users may have posted, feel free to voice out your thoughts and opinions so long as they don't conflict with the rules laid out.
              </p>
              <br />
            </div>
            
          </div>
        </div>
      </div>
      <!-- End Introduction Content -->
      <!-- Begin CTA Section -->
      <div class="section-dark cta">
        <div class="container">
          <div
            class="columns is-multiline"
            data-aos="fade-in"
            data-aos-easing="linear"
          >
            <div class="column is-12 about-me">
              <h1 class="title has-text-centered section-title">
                Get Involved
              </h1>
            </div>
            <div class="column is-10 has-text-centered is-offset-1">
              <h2 class="subtitle">
                If you're interested to apply for a position to help manage this website, don't hesitate to reach out!
              </h2>
              <form action="example.docs">
                <button class="button">
                  Get in Touch
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End CTA Section -->
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