<!DOCTYPE html>
<html>

<!-- TODO: CREATE THE 'DONE' EDITING FUNCTIONALITY TO COMPLETE THE CREATION PROCESS  -->
<!-- TODO: AFTER CREATING A CANDIDATE, CREATE FUNCTIONALITY THAT'LL PRINT THE SET DATA FROM THE DATABASE -->

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

// IF SCRIPT HAS REACHED THIS FAR, FETCH INFO
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

    <link rel="stylesheet" href="../resources/css/tabs.css">
    <link rel="stylesheet" href="../resources/css/voterscompanion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7dc3015a44.js" crossorigin="anonymous"></script>


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
                            <?php
                            echo $candidate_basic["full_name"]; 
                            ?>
                        </p>
                        <p class="subtitle">
                            <?php
                            echo $pos_string . " Candidate #" . $candidate_extra["candidate_num"];
                            echo "<br>";
                            echo $candidate_basic["bio"];
                            if(isEditor()){
                                echo "<br><button class='button is-small is-success' name='done' data-target-candidate='" . $candidate_basic["full_name"] . "'>Save Edits</button>";
                                }
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
            <div class="tab-pane is-active" id="pane-1">
                <div class="content">
                    <h1><?php
                        echo $candidate_basic["full_name"];
                        ?></h1>
                    <p><em>Infomation regarding the candidate's background, family, past jobs or work experience and criminal record.</em></p>

                    <dl>
                        <dt><strong>Birthday:</strong>
                            <?php
                            if (isEditor()) {
                                echo "<button class='button is-small is-info' name='editBirthday'>Edit</button> ";
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
                                <select name='religion-select'> ";
                                queryReligionforEditor(
                                    $DB_CREDENTIALS,
                                    $_GET["cid"]
                                );
                                echo "</select>
                              </div>";
                            }
                            echo "<p name='religion-text'>"
                                . $candidate_extra["religion_id"]
                                . "</p>";
                            ?>
                        </dd><br>

                        <!-- <dt><strong>Martial Status:</strong>
                            <?php
                            // if (isEditor()) {
                            //     echo "<button class='button is-small is-info' name='editMartial'>Edit</button>";
                            // }
                            ?>
                        </dt><br>
                        <dd>
                            <div id="CK-marital">
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
                        <?php
                        echo $candidate_extra["criminal_txt"];
                        ?>
                    </div>
                    <br><br><br><br><br>
                </div>
            </div>


            <!--Affiliated Party-->
            <div class="tab-pane is-center" id="pane-3">
                
             <div class="content">
                <?php
                if (isEditor()) {
                echo "<button class='button is-small is-info' name='editOrg'>Edit</button> 
                <button class='button is-small is-success' name='done' data-target-candidate='" . $candidate_basic["full_name"] . "'>Done</button>";
                }
                ?><br><br>
                <div id="CK-org">
                <?php
                echo $candidate_extra["org_txt"];
                ?>
                </div>
                                
             </div>
             <br><br><br><br><br>
            </div>
               


            <!--Platform-->
            <div class="tab-pane is-center" id="pane-4">
                <div class="content">
                <?php
                    if (isEditor()) {
                    echo "<button class='button is-small is-info' name='editPlatform'>Edit</button> 
                    <button class='button is-small is-success' name='done' data-target-candidate='" . $candidate_basic["full_name"] . "'>Done</button>";
                    }
                    ?><br><br>
                    <div id="CK-platform">
                        <?php
                        echo $candidate_extra["platform_txt"];
                        ?>
                    </div>
                <br><br><br><br><br>
                </div>
            </div>

            <!--interview-->
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
            <div class="tab-pane is-center" id="pane-2">
                <div class="content">
                    <?php
                    if (isEditor()) {
                    echo "<button class='button is-small is-info' name='editAccomplishments'>Edit</button> ";
                    }
                    ?><br><br>
                    <div id="CK-accomplishments">
                        <?php
                        echo $candidate_extra["accomplishments_txt"];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../resources/ckeditor/build/ckeditor.js"></script>
    <script src="../resources/js/ckeditors.js"></script>
    <script src="../resources/js/bulma.js"></script>
    <script src="../resources/js/tabs.js"></script>
</body>

</html>