<?php
require_once '../phpScripts/usr_page_functions.php';
require_once '../phpScripts/globals.php';

?>
<!--HEADER-->
<section class="headerhero">
  <div class="hero-body">
    <p class="headertitle" style="text-align: center;">
      Voters' Companion
    </p>
    <p class="headersubtitle" style="text-align: center;">
      <em>Your one stop shop for voting and candidate information!</em>
    </p>
  </div>
</section>

<!--NAV BAR-->
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="../index.php">
      <img src="../resources/images/VC-logo" width="112" height="25">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="../index.php">
        Home
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Candidates
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="Candidates.php?pos_id=P">
            Presidential
          </a>
          <a class="navbar-item" href="Candidates.php?pos_id=VP">
            Vice Presidential
          </a>
          <a class="navbar-item" href="Candidates.php?pos_id=S">
            Senatorial
          </a>

        </div>
      </div>
      <a class="navbar-item" href="AboutUs.php">
        About Us
      </a>

      <?php

      if (isLoggedIn())
      {
        
      //$acc_type = fetchAccTBL($DB_CREDENTIALS, "type");
      echo
      "<a class='navbar-item' href='ForumPage.php'>
        Forums
        
      </a>";


      if(isAdmin($DB_CREDENTIALS)){
      echo
      "<a class='navbar-item' href='adminPage.php'>
       <strong style='color: blue;'> Manage Accounts </strong>
      </a>";
      }

      }
      ?>
    </div>

    <div class="navbar-end">

      <div class="navbar-item">
        <div class="buttons">
          <?php
          if (isLoggedIn()) {
            echo
            "
                            <a class='button is-link' href='usrPage.php'>
                            <strong>My Profile</strong>
                            </a>
                            <a class='button is-light' href='../phpScripts/logout.php'>
                                Log Out
                            </a>
                            ";
          } else {
            echo
            "
                            <a class='button is-link' href='usrRegister.php'>
                            <strong>Sign up</strong>
                            </a>
                            <a class='button is-light' href='usrLogin.php'>
                                Log in
                            </a>
                                ";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</nav>