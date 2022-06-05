<!DOCTYPE html>
<html>

<?php
include_once '../phpScripts/candidates_page_functions.php';
include_once '../phpScripts/globals.php';


/* 
VALIDATION OF REQUEST FROM URL
*/

if (!(validateRequestType()))
    returnToOverviewPage();

if (!(checkCandidateParamExist()))
    returnToOverviewPage();
else {
    $candidate = new CandidateInformationClass(
        new mysqli(
            $DB_CREDENTIALS["server"],
            $DB_CREDENTIALS["user"],
            $DB_CREDENTIALS["pass"],
            $DB_CREDENTIALS["db_name"],
            $DB_CREDENTIALS["port"]
        ),
        $_GET["cid"]
    );
}

if ($candidate->validateCandidate()) {
    $candidate->fetchInfo();
} else {
    returnToOverviewPage();
}

$candidate_basic = $candidate->getBasicInfo();
$candidate_extra = $candidate->getExtraInfo();
$pos_string = "";

if ($candidate_basic["position_id"] == "P") {
    $pos_string = "Presidential";
} else if ($candidate_basic["position_id"] == "VP") {
    $pos_string = "Vice Presidential";
} else if ($candidate_basic["position_id"] == "S") {
    $pos_string = "Senatorial";
} else {
    returnToOverviewPage();
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voters' Companion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

    <link rel='stylesheet prefetch' href='https://unpkg.com/bulma@0.9.0/css/bulma.min.css'>
    <link rel="stylesheet" href="../resources/css/tabs.css">
    <link rel="stylesheet" href="../resources/css/voterscompanion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>

    <script src="../resources/ckeditor/build/ckeditor.js"></script>
    <script src="../resources/js/ckeditors.js"></script>
    <script src="../resources/js/bulma.js"></script>
    <script src="../resources/js/tabs.js"></script>
    <script src="../resources/js/platform.js"></script>


    <style>
        .has-bg-img {
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAa8AAAB1CAMAAADOZ57OAAAANlBMVEUAdP4EMv4ELP4Ad/4ELf4BY/4CW/4BXv4BYP4DWf4DV/4DVf4DTv4BXP4DUv4DUP4BZf4DS/5B5NwOAAACFElEQVR4nO3VCU4DMRBEUU8cAtkI3P+yBAgiyWy2R5qukv4/gaWnaqduQZtjTrRuS7gOcK0eXF7B5RVcXrVy7eEKiXV5xbq8gssruLyCyyu4vKrm2sEVGevyinV5BZdXcHkFl1dweVXOdYZLINblFVxecQy9gssruLyCy6sCrle4dGJdXsHlFcfQK7i8gssruLya4nqDSy7W5RVcXnEMvYLLK7i8gssruLyCyyu4vILLqx7XC1zKPXFtWZd2rMsruLx6OIZwyQeXVxxDr+DyimPoFVxecQydyol1GZV3CS6f8nmTOIY2Xbm6q9fmAy6HvrmuXlu4LPrh6hJcHv1ydYm/y6IbVxf9Dirqjwsvi/LuxoWXQ/9ceBl0x4WXfvdceMmX93dceKn3sC681Hviwku7x2OIl3g9LryU63PhJdwAF1665UOfCy/ZBrnwUm3oGOIl2/C68BJtjAsvyUa58FJsnAsvwfJxlAsvvaa48JJr4hjipdfkuvBSa4YLL63muPCSapYLL6XmufASqoALL51KuPCSqYgLL5XyewkXXiIVcuGlUSkXXhIVc+GlUDkXXgJVcOEVXw0XXuHlSwUXXtHVceEVXCUXXrHVcuEVWjUXXpHVc+EVWAMXXnHlUz0XXmHl07aeC6+omtaFV1SNXHjF1HYM8QqqmQuviNq58ApoARde67eEC6/VW8SF19rlzyVc3RceLRWbBjPEzQAAAABJRU5ErkJggg==')center center;
            background-size: cover;
        }
    </style>

    <?php
    include_once '../phpPages/footer-header/header.php'
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
                            <!-- President 1 -->
                            <?php
                            echo $candidate_basic["full_name"];
                            ?>
                        </p>
                        <p class="subtitle">
                            <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum. -->
                            <?php
                            echo $pos_string . " Candidate #" . $candidate_extra["candidate_num"];
                            echo "<br>";
                            echo $candidate_basic["bio"];
                            ?>
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
                    <h1><?php
                        echo $candidate_basic["full_name"];
                        ?></h1>
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
                            <div id="CK-birthday">
                                <?php
                                echo $candidate_extra["birthday"];
                                ?>
                            </div>
                        </dd><br>


                        <dt><strong>Birthplace:</strong>
                            <?php
                            if (isEditor()) {
                                echo "<button class='button is-small is-info' name='editBirthplace'>Edit</button>";
                            }
                            ?>
                        </dt>
                        <dd>
                            <div id="CK-birthplace">
                                <!-- Text -->
                                <?php
                                echo $candidate_extra["birthplace"];
                                ?>
                            </div>
                        </dd><br>

                        <dt><strong>Religion:</strong></dt>
                        <dd>
                            <?php
                            if (isEditor()) {
                                echo
                                "
                                <div class='select is-primary'>
                                <select name='c-cand-pos'> ";
                                queryReligionforEditor($DB_CREDENTIALS);
                                echo "</select>
                              </div>
                                ";
                            }
                            echo $candidate_extra["religion_id"];
                            ?>
                            <!-- Text -->
                        </dd><br>

                        <!-- <dt><strong>Martial Status:</strong>
                            <?php
                            // if (isEditor()) {
                            //     echo "<button class='button is-small is-info' name='editMartial'>Edit</button>";
                            // }
                            ?>
                        </dt><br>
                        <dd>
                            <div id="CK-martial">
                            </div>
                        </dd><br> -->
                    </dl>

                    <h2>Education</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editEdu'>Edit</button>";
                    }
                    ?>
                    <br><br>
                    <div id="CK-education">
                        <!-- <p>Shoto Todoroki took hero class in U.A. High School as one of the top students.</p>
                        <ul>
                            <li>A.B. in Fire Weilding Powers</li>
                            <li>Doctor of Ice Weilding Powers</li>
                            <li>Passed the Hero's License Exam</li>
                        </ul><br> -->
                        <?php
                        echo $candidate_extra["education_txt"];
                        ?>
                    </div>

                    <h2>Work Experience</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editWE'>Edit</button>";
                    }
                    ?><br><br>
                    <div id="CK-work">
                        <!-- <p>Promising intern of hero firms around Japan, He had 4.123 intern offerships.</p>
                        <ul>
                            <li>Hero Agency Internship under Endeavor</li>
                        </ul> <br> -->
                        <?php
                        echo $candidate_extra["experience_txt"];
                        ?>
                    </div>

                    <h2>Criminal Record</h2>
                    <?php
                    if (isEditor()) {
                        echo "<button class='button is-small is-info' name='editCR'>Edit</button>";
                    }
                    ?>
                    <br>
                    <div id="CK-criminal">
                        <!-- <p><em>Free of any criminal</em></p> -->
                        <?php
                        echo $candidate_extra["criminal_txt"];
                        ?>
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

            <!--Accomplishments-->
            <div class="tab-pane is-active" id="pane-2">
                <div class="content">
                    <h1>Accomplishment 1 (Can Add Pictures)</h1>
                    <div id="editor2"></div>
                    <h2>Accomplishment</h2>
                    <p>Curabitur accumsan turpis pharetra blandit. Quisque condimentum maximus mi, sit amet commodo arcu rutrum id. Proin pretium urna vel cursus venenatis. Suspendisse potenti. Etiam mattis sem rhoncus lacus dapibus facilisis. Donec at dignissim dui. Ut et neque nisl.</p>
                    <ul>
                        <li>In fermentum leo eu lectus mollis, quis dictum mi aliquet.</li>
                        <li>Morbi eu nulla lobortis, lobortis est in, fringilla felis.</li>
                        <li>Aliquam nec felis in sapien venenatis viverra fermentum nec lectus.</li>
                        <li>Ut non enim metus.</li>
                    </ul>
                    <h3>Accomplishment 2</h3>
                    <p>Quisque ante lacus, malesuada ac auctor vitae, congue. Phasellus lacus ex, semper ac tortor nec, fringilla condimentum orci. Fusce eu rutrum tellus.</p>
                    <ol>
                        <li>Donec blandit a lorem id convallis.</li>
                        <li>Cras gravida arcu at diam gravida gravida.</li>
                        <li>Integer in volutpat libero.</li>
                        <li>Donec a diam tellus.</li>
                        <li>Aenean nec tortor orci.</li>
                        <li>Quisque aliquam cursus urna, non bibendum massa viverra eget.</li>
                        <li>Vivamus maximus ultricies pulvinar.</li>
                    </ol>
                    <blockquote>Ut venenatis, nisl scelerisque sollicitudin fermentum, quam libero hendrerit ipsum, ut blandit est tellus sit amet turpis.</blockquote>
                    <p>Quisque at semper enim, eu hendrerit odio. Etiam auctor nisl et <em>justo sodales</em> elementum. Maecenas ultrices lacus quis neque consectetur, et lobortis nisi molestie.</p>
                    <p>Sed sagittis enim ac tortor maximus rutrum. Nulla facilisi. Donec mattis vulputate risus in luctus. Maecenas vestibulum interdum commodo.</p>
                    <dl>
                        <dt>Web</dt>
                        <dd>The part of the Internet that contains websites and web pages</dd>
                        <dt>HTML</dt>
                        <dd>A markup language for creating web pages</dd>
                        <dt>CSS</dt>
                        <dd>A technology to make HTML look better</dd>
                    </dl>
                    <p>Suspendisse egestas sapien non felis placerat elementum. Morbi tortor nisl, suscipit sed mi sit amet, mollis malesuada nulla. Nulla facilisi. Nullam ac erat ante.</p>
                    <h4>Fourth level</h4>
                    <p>Nulla efficitur eleifend nisi, sit amet bibendum sapien fringilla ac. Mauris euismod metus a tellus laoreet, at elementum ex efficitur.</p>
                    <pre>
                     &lt;!DOCTYPE html&gt;
                        &lt;html&gt;
                        &lt;head&gt;
                        &lt;title&gt;Hello World&lt;/title&gt;
                        &lt;/head&gt;
                        &lt;body&gt;
                        &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra nec nulla vitae mollis.&lt;/p&gt;
                        &lt;/body&gt;
                    &lt;/html&gt;
            </pre>
                    <p>Maecenas eleifend sollicitudin dui, faucibus sollicitudin augue cursus non. Ut finibus eleifend arcu ut vehicula. Mauris eu est maximus est porta condimentum in eu justo. Nulla id iaculis sapien.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>One</th>
                                <th>Two</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Three</td>
                                <td>Four</td>
                            </tr>
                            <tr>
                                <td>Five</td>
                                <td>Six</td>
                            </tr>
                            <tr>
                                <td>Seven</td>
                                <td>Eight</td>
                            </tr>
                            <tr>
                                <td>Nine</td>
                                <td>Ten</td>
                            </tr>
                            <tr>
                                <td>Eleven</td>
                                <td>Twelve</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Phasellus porttitor enim id metus volutpat ultricies. Ut nisi nunc, blandit sed dapibus at, vestibulum in felis. Etiam iaculis lorem ac nibh bibendum rhoncus. Nam interdum efficitur ligula sit amet ullamcorper. Etiam tristique, leo vitae porta faucibus, mi lacus laoreet metus, at cursus leo est vel tellus. Sed ac posuere est. Nunc ultricies nunc neque, vitae ultricies ex sodales quis. Aliquam eu nibh in libero accumsan pulvinar. Nullam nec nisl placerat, pretium metus vel, euismod ipsum. Proin tempor cursus nisl vel condimentum. Nam pharetra varius metus non pellentesque.</p>
                    <h5>Fifth level</h5>
                    <p>Aliquam sagittis rhoncus vulputate. Cras non luctus sem, sed tincidunt ligula. Vestibulum at nunc elit. Praesent aliquet ligula mi, in luctus elit volutpat porta. Phasellus molestie diam vel nisi sodales, a eleifend augue laoreet. Sed nec eleifend justo. Nam et sollicitudin odio.</p>
                    <figure>
                        <img src="https://bulma.io/images/placeholders/256x256.png" alt="💯">
                        <img src="https://bulma.io/images/placeholders/256x256.png" alt="💯">
                        <figcaption>
                            Figure 1: Some beautiful placeholders
                        </figcaption>
                    </figure>
                    <h6>Sixth level</h6>
                    <p>Cras in nibh lacinia, venenatis nisi et, auctor urna. Donec pulvinar lacus sed diam dignissim, ut eleifend eros accumsan. Phasellus non tortor eros. Ut sed rutrum lacus. Etiam purus nunc, scelerisque quis enim vitae, malesuada ultrices turpis. Nunc vitae maximus purus, nec consectetur dui. Suspendisse euismod, elit vel rutrum commodo, ipsum tortor maximus dui, sed varius sapien odio vitae est. Etiam at cursus metus.</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>