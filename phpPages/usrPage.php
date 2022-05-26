<?php
require_once '../phpScripts/usr_page_functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/home.css" />

    <link rel="stylesheet" href="../resources/css/voterscompanion.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Page</title>
</head>


<?php

require_once 'footer-header/header.php';

?>

<body>

    <!-- USER INFORMATION SECTION -->
    <section class="section">
        <div class="container">
            <!-- IMAGE -->
            <div class="columns">
                <div class="column">
                    <figure class="image is-128x128 mx-auto">
                        <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                    </figure>
                </div>
                <div class="columns is-flex-direction-column container">
                    <!-- USER NAME -->
                    <div class="column block">
                        <?php
                        if (isLoggedIn()) {
                            echo "<h1 class='title is-1'>" . selectSelfNameCookie() . "</h1>";
                        } else {
                            echo "<h1 class='title is-1'>User Profile</h1>";
                        }
                        ?>
                    </div>
                    <hr class="prf-divider">
                    <!-- USER DESCRIPTION -->
                    <div class="column block">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lacinia dolor in neque
                            aliquam, at accumsan odio scelerisque. Nulla facilisi. Maecenas pharetra accumsan enim sit
                            amet ullamcorper. Nam nec tincidunt mi, non rhoncus lacus. Nam a ligula orci. Donec gravida
                            vel neque sed cursus. Aenean congue fringilla rhoncus. Etiam id accumsan tortor, sit amet
                            suscipit quam. Ut viverra, orci et tempor eleifend, risus ex pharetra odio, ac pharetra
                            ligula nisi quis enim. Maecenas id tellus sed justo sagittis vulputate. Nulla nunc ipsum,
                            porttitor sed tortor non, tempor lobortis purus.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CHOSEN CANDIDATES SECTION -->
    <section class="section">
        <!-- TABS -->
        <div class="container outline-1">
            <div class="tabs is-fullwidth is-centered">
                <ul>
                    <li class="is-active">
                        <a>
                            <span>Supported Candidates</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <span>Thread History</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CONTAINER FOR THE CHOSEN CANDIDATES -->
            <div>
                <div class="columns">
                    <div class="column has-text-centered">
                        <h1 class="title is-1">President</h1>
                        <figure class="image is-128x128 mx-auto">
                            <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                        </figure>
                        <h2 class="title is-3">Name</h2>
                        <a href="">Learn More</a>
                    </div>

                    <div class="column has-text-centered">
                        <h1 class="title is-1">Vice President</h1>
                        <figure class="image is-128x128 mx-auto">
                            <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                        </figure>
                        <h2 class="title is-3">Name</h2>
                        <a href="">Learn More</a>
                    </div>
                </div>

                <!-- SEPERATOR FOR THE SENATORS -->
                <div class="has-text-centered">
                    <p>Senatorial Candidates</p>
                </div>

                <div class="column">
                    <!-- ROW 1 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 1</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 2</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 3</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 4</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 5</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 6</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 7</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 8</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 9</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 4 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 10</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 11</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-1">Senator 12</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="../resources/images/usr_generic/profile-user.png" alt="usrProfilePicture">
                                </figure>
                                <h2 class="title is-3">Name</h2>
                                <a href="">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

    <!-- FOOTER SECTION -->
    <!-- Begin Footer -->
    <footer class="footer">
        <p>
            <strong class="white">Voter's Companion</strong> by <a href="AboutUs.php">Team Hapon</a>
            As a project for their software engineering class in
            <a href="https://iacademy.edu.ph">iACADEMY</a>.
        </p>
    </footer>
    <!-- End Footer -->
</body>

</html>