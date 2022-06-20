
<?php
require_once '../phpScripts/globals.php';
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

    <style>
        .has-bg-img { background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAa8AAAB1CAMAAADOZ57OAAAANlBMVEUAdP4EMv4ELP4Ad/4ELf4BY/4CW/4BXv4BYP4DWf4DV/4DVf4DTv4BXP4DUv4DUP4BZf4DS/5B5NwOAAACFElEQVR4nO3VCU4DMRBEUU8cAtkI3P+yBAgiyWy2R5qukv4/gaWnaqduQZtjTrRuS7gOcK0eXF7B5RVcXrVy7eEKiXV5xbq8gssruLyCyyu4vKrm2sEVGevyinV5BZdXcHkFl1dweVXOdYZLINblFVxecQy9gssruLyCy6sCrle4dGJdXsHlFcfQK7i8gssruLya4nqDSy7W5RVcXnEMvYLLK7i8gssruLyCyyu4vILLqx7XC1zKPXFtWZd2rMsruLx6OIZwyQeXVxxDr+DyimPoFVxecQydyol1GZV3CS6f8nmTOIY2Xbm6q9fmAy6HvrmuXlu4LPrh6hJcHv1ydYm/y6IbVxf9Dirqjwsvi/LuxoWXQ/9ceBl0x4WXfvdceMmX93dceKn3sC681Hviwku7x2OIl3g9LryU63PhJdwAF1665UOfCy/ZBrnwUm3oGOIl2/C68BJtjAsvyUa58FJsnAsvwfJxlAsvvaa48JJr4hjipdfkuvBSa4YLL63muPCSapYLL6XmufASqoALL51KuPCSqYgLL5XyewkXXiIVcuGlUSkXXhIVc+GlUDkXXgJVcOEVXw0XXuHlSwUXXtHVceEVXCUXXrHVcuEVWjUXXpHVc+EVWAMXXnHlUz0XXmHl07aeC6+omtaFV1SNXHjF1HYM8QqqmQuviNq58ApoARde67eEC6/VW8SF19rlzyVc3RceLRWbBjPEzQAAAABJRU5ErkJggg==')center center; background-size:cover; }
    </style>

  </head>


  <?php

    require_once 'footer-header/header.php';

    //Fill up variables
    $president_names = fetchCandidateNames($DB_CREDENTIALS,'P');
    $vice_pres_names = fetchCandidateNames($DB_CREDENTIALS,'VP');
    $senator_names = fetchCandidateNames($DB_CREDENTIALS,'S'); 

    //Fill up preferred Candidates
    $president_pick;
    $vice_pres_pick;
    $senator_picks;

    $acc_id = fetchAccId($DB_CREDENTIALS);
    

  ?>

<script>


</script>

 
<body>


  <!--Tabs-->
<section class="hero is-link">
    <div class="hero-body">
        <div class="container">
        <div class="media">
            <div class="media-left">
            <figure class="image is-128x128">
                <?php
                    $img_src = fetchPersonalInfo($DB_CREDENTIALS,'image_url');

                    if ($img_src != null){
                        echo  "<img class='is-rounded' src='../resources/images/user_images/$img_src'>";
                    }
                    else{
                      echo  "<img class='is-rounded' src='http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png'>"; 
                    }
                ?>
            </figure>
        <br>
        <?php if (isset($_GET['error'])): ?>
		<p><?php echo "<p class='columns is-one-quarter'>". $_GET['error']."</p>"; ?></p>
	    <?php endif ?>
        <form action="../phpScripts/uploadImage.php"
           method="post"
           enctype="multipart/form-data">
            <br>
            <?php

                echo "<input type='hidden' name='acc_id' value='$acc_id'>";

            ?>
            
           <input class="input is-primary columns is-one-quarter is-small" type="file" 
                  name="my_image">
            
           <input type="submit" 
                  name="submit"
                  value="Upload"
                  class="button is-primary columns is-one-quarter">
     	
     </form>
          </div>
          <div class="media-content">
            <p class="title">
            &nbsp;

                <?php
                        $full_name = fetchPersonalInfo($DB_CREDENTIALS,"full_name");

                        if (isLoggedIn()) {
                            echo "<h1 class='title is-1'>" . $full_name . "</h1>";
                        } else {
                            echo "<h1 class='title is-1'>User Profile</h1>";
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
                    <span>Supported Candidates</span>
                </a>
            </li>
         
            <li data-target="pane-3" id="3">
                <a>
                    <span class="icon is-small"><i class="fa fa-user-plus"></i></span>
                    <span>Personal Information</span>
                </a>
            </li>
        </ul>
    </div>

   
    <div class="tab-content">
            <div class="tab-pane is-active" id="pane-1">
             <!-- CONTAINER FOR THE CHOSEN CANDIDATES -->
             <form action="" method="POST">
                <div class="columns" >
                    <div class="column has-text-centered">
                        <h1 class="title is-2" style="color: black;">President</h1>
                        <figure class="image is-128x128 mx-auto">
                            <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                        </figure>
                        <h2 class="title is-2" style="color: black;">
                        <select id="president_id_input" name="president_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                            <?php
                            foreach($president_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                        </select>
                        </h2>
                        
                    </div>

                    <div class="column has-text-centered" >
                        <h1 class="title is-2" style="color: black;">Vice President</h1>
                        <figure class="image is-128x128 mx-auto">
                            <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                        </figure>
                        <h2 class="title is-2" style="color: black;">
                        <select id="v_president_id_input" name="v_president_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                            <?php
                            foreach($vice_pres_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                        </select>
                        </h2>                        
                    </div>
                </div>
        
                <br><br>
                <!-- SEPERATOR FOR THE SENATORS -->
                <div class="has-text-centered">
                    <h2 class="title" style="color: black;"> <em>Senatorial Candidates</em></h2>
                </div>

                <div class="column" style="padding-bottom: 3em;">
                    <!-- ROW 1 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 1</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen1_id_input" name="sen1_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                            <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat" >ABSTAIN</option>
                        </select>
                        </h2>                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 2</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen2_id_input" name="sen2_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat" >ABSTAIN</option>
                        </select>
                        </h2>                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 3</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen3_id_input" name="sen3_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat" >ABSTAIN</option>
                        </select>
                        </h2>                                
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- ROW 2 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 4</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen4_id_input" name="sen4_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat" >ABSTAIN</option>
                        </select>
                        </h2>                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 5</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen5_id_input" name="sen5_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat" >ABSTAIN</option>
                        </select>
                        </h2>                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 6</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen6_id_input" name="sen6_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                            <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?> 
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>                                
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- ROW 3 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 7</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen7_id_input" name="sen7_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>
                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 8</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen8_id_input" name="sen8_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>
                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 9</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen9_id_input" name="sen9_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>
                                
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- ROW 4 -->
                    <div class="column">
                        <div class="columns">
                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 10</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen10_id_input" name="sen10_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>
                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 11</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen11_id_input" name="sen11_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                           
                        </select>
                        </h2>
                                
                            </div>

                            <div class="column has-text-centered">
                                <h1 class="title is-3" style="color: black;">Senator 12</h1>
                                <figure class="image is-128x128 mx-auto">
                                    <img class="is-rounded" src="http://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="usrProfilePicture">
                                </figure>
                                <br>
                                <h2 class="title is-2" style="color: black;">
                        <select id="sen12_id_input" name="sen12_id_input" class="input is-primary" type="dr" placeholder="Primary input" >
                        <?php
                            foreach($senator_names as $names){
                              echo "<option value='".$names."'>".$names."</option>";
                            }
                            ?>
                            <option value="fiat">ABSTAIN</option>
                            
                        </select>
                        </h2>
                                
                            </div>
                        </div>
                    </div>    
                </div>
                
                <div class="columns is-centered"> 
                    <button class="button is-primary is-large columns">Save Changes</button>
                </div>

                <?php
                    // if(isset($president_id_input))
                    //         echo "<h1> ANG LUPET MO!! $president_id_input"; 
                ?>
            </div>

            </form> 
        
        

        <!--Personal Details-->
        <div class="tab-pane is-active" id="pane-3">
            <div class="content">
                <dl>
                    <dt><strong>Name:</strong></dt> 
                    <?php
                        $full_name = fetchPersonalInfo($DB_CREDENTIALS,"full_name");
                        
                        if (isLoggedIn()) {
                            echo "<dd>".$full_name."</dd><br>";
                        } else {
                            echo "<dd> Name Here</dd><br>";
                        }

                    ?>
                    

                    <dt><strong>Bio:</strong></dt>
                    <?php
                        $bio = fetchPersonalInfo($DB_CREDENTIALS,"bio");
                        
                        if (isLoggedIn()) {
                            echo "<dd>".$bio."</dd><br>";
                        } else {
                            echo "<dd> Name Here</dd><br>";
                        }

                    ?>

                    <dt><strong>Birthday:</strong></dt> 
                    <?php
                        $bday = fetchPersonalInfo($DB_CREDENTIALS,"birthday");
                        
                        if (isLoggedIn()) {
                            echo "<dd>".$bday."</dd><br>";
                        } else {
                            echo "<dd> Name Here</dd><br>";
                        }

                    ?>

                    <dt><strong>Relgion:</strong></dt> 
                    <?php
                        $religion = fetchPersonalInfo($DB_CREDENTIALS,"religion_id");
                        
                        if (isLoggedIn()) {
                            echo "<dd>".$religion."</dd><br>";
                        } else {
                            echo "<dd> Name Here</dd><br>";
                        }

                    ?>

                    <dt><strong>Marital Status:</strong></dt> 
                    <?php
                        $status = fetchPersonalInfo($DB_CREDENTIALS,"status_id");
                        
                        if (isLoggedIn()) {
                            echo "<dd>".$status."</dd><br>";
                        } else {
                            echo "<dd> Name Here</dd><br>";
                        }

                    ?>
                </dl>
            </div>
        </div>


    </div>
</div>
</section>
<script src="../resources/js/bulma.js"></script>
<script src="../resources/js/tabs.js"></script>
<script src="../resources/js/platform.js"></script>
</body>
</html>