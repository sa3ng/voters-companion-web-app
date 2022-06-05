<?php

include_once '../phpScripts/candidates_page_functions.php';
include_once '../phpScripts/globals.php';

/* 
WE MUST MAKE SURE THAT THE USER DOESN'T COME FROM INVALID REQUESTS/REDIRECTS:
Lines the three if-else lines underneath attempt to do this
*/

if (!(validateRequestType()))
    returnToOverviewPage();

if (!(checkCandidateParamExist()))
    returnToOverviewPage();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voters' Companion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

    <link rel='stylesheet prefetch' href='https://unpkg.com/bulma@0.9.0/css/bulma.min.css'>
    <link rel="stylesheet" href="../resources/css/voterscompanion.css">
    <link rel="stylesheet" href="../resources/css/tabs.css">

    <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="../resources/js/tabs.js"></script>
    <script src="../resources/js/platform.js"></script>
    <script src="../resources/ckeditor/build/ckeditor.js"></script>
    <script src="../resources/js/ckeditors.js"></script>

    <style>
        .has-bg-img {
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAa8AAAB1CAMAAADOZ57OAAAANlBMVEUAdP4EMv4ELP4Ad/4ELf4BY/4CW/4BXv4BYP4DWf4DV/4DVf4DTv4BXP4DUv4DUP4BZf4DS/5B5NwOAAACFElEQVR4nO3VCU4DMRBEUU8cAtkI3P+yBAgiyWy2R5qukv4/gaWnaqduQZtjTrRuS7gOcK0eXF7B5RVcXrVy7eEKiXV5xbq8gssruLyCyyu4vKrm2sEVGevyinV5BZdXcHkFl1dweVXOdYZLINblFVxecQy9gssruLyCy6sCrle4dGJdXsHlFcfQK7i8gssruLya4nqDSy7W5RVcXnEMvYLLK7i8gssruLyCyyu4vILLqx7XC1zKPXFtWZd2rMsruLx6OIZwyQeXVxxDr+DyimPoFVxecQydyol1GZV3CS6f8nmTOIY2Xbm6q9fmAy6HvrmuXlu4LPrh6hJcHv1ydYm/y6IbVxf9Dirqjwsvi/LuxoWXQ/9ceBl0x4WXfvdceMmX93dceKn3sC681Hviwku7x2OIl3g9LryU63PhJdwAF1665UOfCy/ZBrnwUm3oGOIl2/C68BJtjAsvyUa58FJsnAsvwfJxlAsvvaa48JJr4hjipdfkuvBSa4YLL63muPCSapYLL6XmufASqoALL51KuPCSqYgLL5XyewkXXiIVcuGlUSkXXhIVc+GlUDkXXgJVcOEVXw0XXuHlSwUXXtHVceEVXCUXXrHVcuEVWjUXXpHVc+EVWAMXXnHlUz0XXmHl07aeC6+omtaFV1SNXHjF1HYM8QqqmQuviNq58ApoARde67eEC6/VW8SF19rlzyVc3RceLRWbBjPEzQAAAABJRU5ErkJggg==')center center;
            background-size: cover;
        }
    </style>
    <?php

    require_once 'footer-header/header.php';

    ?>
</head>

<body>


    <!--Tabs-->
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-128x128">
                            <img class="is-rounded" src="https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title">
                            President 1
                        </p>
                        <p class="subtitle">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabs is-boxed is-centered main-menu" id="nav">
            <ul>
                <li data-target="pane-1" id="1" class="is-active">
                    <a>
                        <span class="icon is-small"><i class="fa fa-id-card"></i></span>
                        <span>Personal Details</span>
                    </a>
                </li>
                <li data-target="pane-2" id="2">
                    <a>
                        <span class="icon is-small"><i class="fa fa-briefcase"></i></span>
                        <span>Accomplishments</span>
                    </a>
                </li>
                <li data-target="pane-3" id="3">
                    <a>
                        <span class="icon is-small"><i class="fa fa-user-plus"></i></span>
                        <span>Affiliated Party & Orgs</span>
                    </a>
                </li>
                <li data-target="pane-4" id="4">
                    <a>
                        <span class="icon is-small"><i class="fa fa-globe"></i></span>
                        <span>Platform</span>
                    </a>
                </li>
                <li data-target="pane-5" id="5">
                    <a>
                        <span class="icon is-small"><i class="fa fa-video"></i></span>
                        <span>Interviews</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!--Personal Details-->
            <div class="tab-pane is-center" id="pane-1">
                <div class="content">
                    <h1>Shoto Todoroki</h1>
                    <p><em>Infomation regarding the candidate's background, family, past jobs or work experience and criminal record.</em></p>

                    <dl>
                        <dt><strong>Birthday:</strong>
                            <?php
                            if (isEditor()) {
                                echo "<button class='button is-small is-info' name='editBirthday'>Edit</button> 
                                <button class='button is-small is-success' name='done'>Done</button>";
                            }
                            ?>
                        </dt><br>
                        <dd>
                            <div id="CK-birthday">June 12, 2002</div>
                        </dd><br>


                        <dt><strong>Birthplace:</strong>
                            <?php
                            if (isEditor()) {
                                echo "<button class='button is-small is-info' name='editBirthplace'>Edit</button>";
                            }
                            ?>
                        </dt>
                        <dd>
                            <div id="CK-birthplace">Text</div>
                        </dd><br>

                        <dt><strong>Religion:</strong></dt>
                        <dd>Text</dd><br>

                        <dt><strong>Martial Status:</strong>
                            <?php
                            if (isEditor()) {
                                echo "<button class='button is-small is-info' name='editMartial'>Edit</button>";
                            }
                            ?>
                        </dt><br>
                        <dd>
                            <div id="CK-martial">Text</div>
                        </dd><br>
                    </dl>

                    <h2>Education</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editEdu'>Edit</button>";
                    }
                    ?>
                    <br><br>
                    <div id="CK-education">
                        <p>Shoto Todoroki took hero class in U.A. High School as one of the top students.</p>
                        <ul>
                            <li>A.B. in Fire Weilding Powers</li>
                            <li>Doctor of Ice Weilding Powers</li>
                            <li>Passed the Hero's License Exam</li>
                        </ul><br>
                    </div>

                    <h2>Work Experience</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editWE'>Edit</button>";
                    }
                    ?><br><br>
                    <div id="CK-work">
                        <p>Promising intern of hero firms around Japan, He had 4.123 intern offerships.</p>
                        <ul>
                            <li>Hero Agency Internship under Endeavor</li>
                        </ul> <br>
                    </div>

                    <h2>Criminal Record</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editCR'>Edit</button>";
                    }
                    ?>
                    <br>
                    <div id="CK-criminal">
                        <p><em>Free of any criminal</em></p>
                    </div>

                </div>
            </div>

            <br><br><br><br><br><br><br><br>
            <!--Affiliated Party-->
            <div class="tab-pane" id="pane-3">
                <div class="columns">
                    <div class="container">
                        <div class="content">
                            <h2>Affliated Party and Organizations</h2>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-96x96">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cd/Liberal_Party_of_the_Philippines_%28LP%29.svg/640px-Liberal_Party_of_the_Philippines_%28LP%29.svg.png">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Liberal Party</strong>
                                                <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                            </p>
                                        </div>
                                    </div>
                                </article>
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-96x96">
                                            <img src="https://bulma.io/images/placeholders/96x96.png">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Example Org</strong>
                                                <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="column">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-96x96">
                                            <img src="https://bulma.io/images/placeholders/96x96.png">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Example Org</strong>
                                                <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                            </p>
                                        </div>
                                    </div>
                                </article>
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-96x96">
                                            <img src="https://bulma.io/images/placeholders/96x96.png">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Example Org</strong>
                                                <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis. ╳
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Platform-->
            <div class="tab-pane" id="pane-4">
                <div class="columns is-centered">
                    <div class="column is-three-quarters">
                        <div class="embed-container image">
                            <iframe src="https://www.youtube.com/embed/cAIwQp30dJM" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="pane-5">
                <div class="columns is-centered">
                    <div class="column is-three-quarters">
                        <div class="embed-container image">
                            <iframe src="https://www.youtube.com/embed/cAIwQp30dJM" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>