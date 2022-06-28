<?php

include_once 'globals.php'; // used by: isEditor()
include_once 'usr_page_functions.php'; // used by: isEditor()
include_once '../phpModels/CandidateOverview.php';
include_once '../phpModels/CandidateInformation.php';


function fetchCandidates($db_credentials, $pos_id)
{
  $conn = new mysqli(
    $db_credentials["server"],
    $db_credentials["user"],
    $db_credentials["pass"],
    $db_credentials["db_name"],
    $db_credentials["port"]
  );

  // preparation of prepared statement
  $stmt = $conn->prepare("SELECT * FROM candidatesTBL WHERE position_id=?");
  $stmt->bind_param("s", $pos_id);
  // execution
  $stmt->execute();
  // result retrieval
  $results = $stmt->get_result();
  //define CandidateName as an array
  $candidates_arr = [];

  //Fill up Candidate Names
  while ($current_row = $results->fetch_assoc()) {
    $loc_stmt = $conn->prepare(
      "SELECT candidate_num FROM candidatesInfoTBL 
      WHERE candidate_id=?;"
    );
    $loc_stmt->bind_param("i", $current_row["candidate_id"]);
    $loc_stmt->execute();

    $loc_result = $loc_stmt->get_result()->fetch_assoc();

    /* --------------------------------------------------------------------
    We need to fetch the image of the candidate of the user to display
    -------------------------------------------------------------------- */
    $fetched_img_url = '';

    if (is_null($current_row['image_url'])) {
      $fetched_img_url = "../resources/images/candidate_generic/generic.png";
    } else {
      $fetched_img_url = $current_row['image_url'];
    }

    //--------------------------------------------------------------------


    array_push(
      $candidates_arr,
      new CandidateOverviewClass(
        $current_row["full_name"],
        $current_row["candidate_id"],
        $current_row["bio"],
        $loc_result["candidate_num"],
        $fetched_img_url
      )
    );
    $loc_stmt->close();
  }

  $conn->close();
  $stmt->close();

  return $candidates_arr;
}


function displayCandidates(array $candidates_arr)
{


  $candidates_displayed = 0;
  $candidates_max = sizeof($candidates_arr);
  $end_current_row = false;

  // WHILE THERE ARE STILL CANDIDATES, DISPLAY THEM
  while ($candidates_displayed < $candidates_max) {
    /* 
    IF STARTING TO DISPLAY OR HAS REACHED THE MAX DISPLAY OF 2 ITEMS PER ROW,
    CREATE NEW ROW THROUGH THE COLUMNS CONTAINER
    */
    if (($candidates_displayed == 0 || ($candidates_displayed % 2 == 0)) && $candidates_displayed < $candidates_max) {
      // PRINTING THE BASE CONTAINER FOR THE COLUMNS
      echo "<div class='columns'>";
      $end_current_row = true;



      printCandidateCard($candidates_arr, $candidates_displayed);
      $candidates_displayed++;
    }
    /* 
    PRINT NEXT CARD
    */
    if (($candidates_displayed % 2 != 0) && $candidates_displayed < $candidates_max) {
      printCandidateCard($candidates_arr, $candidates_displayed);

      $candidates_displayed++;
    }

    if ($end_current_row) {
      // ENDING THE BASE CONTAINER HERE
      echo "</div>";
      $end_current_row = false;
    }
  }
}
/* ------------------------------------------------------------------------
Helper function for displaying candidates on the candidate overview page
-------------------------------------------------------------------------*/
function printCandidateCard(array $candidates_arr, int $candidates_displayed)
{
  echo "  <div class='column'>";
  echo "    <div class='card hovereffect'>";
  echo "      <div class='card-content'>";
  echo "        <div class='media'>";
  echo "          <div class='media-left'>";
  echo "            <figure class='image is-128x128'>
                      <img class='is-rounded' src='" . $candidates_arr[$candidates_displayed]->getImgUrl() . "'>
                    </figure>";
  echo "          </div>";
  echo "          <div class='media-content'>";
  /* ------------------------------------------------------------------
   editing the candidate name and description should only be for 
   editors
  ------------------------------------------------------------------ */
  if (isEditor()) {
    echo "            
      <button name='edit-candidate-button' class='button is-small is-info js-modal-trigger' 
      data-target='modal-js-edit'>
      Edit Info</button>
        ";
  }
  // ------------------------------------------------------------------
  echo "            <p class='title'>" . $candidates_arr[$candidates_displayed]->getName() . "</p>";
  echo "            <p class='subtitle'>" . $candidates_arr[$candidates_displayed]->getDescription() . "</p>";
  echo "          </div>";
  echo "        </div>";
  echo "      <footer class='card-footer'>";
  echo "        <p class='card-footer-item'>";
  echo "        <span>";
  echo "          <a name='candidate-link' href='CandidatePage.php?cid=" . $candidates_arr[$candidates_displayed]->getCandidateId() . "'>Learn More</a>";
  echo "        </span>";
  echo "        </p>";
  echo "      <footer>";
  echo "      </div>";
  echo "    </div>";
  echo "  </div>";
}
// ------------------------------------------------------------------------


/* ------------------------------------------------------------------------
function for delete is seperated from upper methods for fetching data
as it can't be instantly overloaded. Seperated functions for now, maybe
code consolidation in the 
-------------------------------------------------------------------------*/
function displayCandidatesToDelete(array $candidates_arr)
{
  $candidates_displayed = 0;
  $candidates_max = sizeof($candidates_arr);

  while ($candidates_max > $candidates_displayed) {
    printDeleteCard($candidates_arr, $candidates_displayed);
    $candidates_displayed++;
  }
}

function printDeleteCard(array $candidates_arr, int $candidates_displayed)
{
  echo
  "
  <div class='card'>
  <header class='card-header'>
    <p class='card-header-title'>" .
    $candidates_arr[$candidates_displayed]->getName()
    . "</p>
  </header>
  <div class='card-content'>
    <div class='content'> 
    Candidates is #" . $candidates_arr[$candidates_displayed]->getPosNum()
    . "</div>
  </div>
  <footer class='class-footer'>
    <a 
      href='#'
      name = 'candidate-delete-link'
      class='card-footer-item' 
      data-name='" . $candidates_arr[$candidates_displayed]->getName()
    . "'>
        Delete
    </a>
  </footer>
  </div>
  <br>
  ";
}

// ------------------------------------------------------------------------


// CANDIDATE PAGE PROPER FUNCTIONS
/* ------------------------------------------------------------------------
these functions should check if the user has passed the request to the 
server
-------------------------------------------------------------------------*/
function validateRequestType()
{
  if (array_key_exists("REQUEST_METHOD", $_SERVER)) {
    if ($_SERVER["REQUEST_METHOD"] == "GET")
      return true;
  }

  // default return
  return false;
}
function checkCandidateParamExist()
{
  if (array_key_exists("cid", $_GET))
    return true;
  return false;
}
// ------------------------------------------------------------------------


function returnToOverviewPage()
{
  header("Location: Candidates.php", true);
  die();
}

function queryCandidate($get_cid, $db_credentials)
{
  $conn = new mysqli(
    $db_credentials["server"],
    $db_credentials["user"],
    $db_credentials["pass"],
    $db_credentials["db_name"],
    $db_credentials["port"]
  );

  // preparation of prepared statement
  $stmt = $conn->prepare("SELECT * FROM candidatesTBL WHERE candidate_id=?");
  $stmt->bind_param("i", $get_cid);

  // execution
  $stmt->execute();
  // result retrievalphpScripts/candidates_page_functions.php
  $results = $stmt->get_result();
  // should only have one result; No need to have a while iterator here

  $candidate = $results->fetch_assoc();
  // closing of connections
  $stmt->close();
  $conn->close();

  if (!(empty($candidate)))
    return $candidate["candidate_id"];

  return -1;
}

function queryReligionforEditor($db_credentials, $candidate_id)
{
  /*
  <option value='P'>President</option>
  <option value='VP'>Vice President</option>
  <option value='S'>Senator</option> 
   */

  $conn = new mysqli(
    $db_credentials["server"],
    $db_credentials["user"],
    $db_credentials["pass"],
    $db_credentials["db_name"],
    $db_credentials["port"]
  );

  /*-----------------------------------------------------------------------
  NEED TO GET USER RELIGION FIRST SO IT WON'T GET OVERWRITTEN ACCIDENTALLY
  WITH THE PRINTING OF DEFAULT VALUES
  -----------------------------------------------------------------------*/

  /*-----------------------------------------------------------------------
  INITIALLY NEED TO GET THE RELIGION CODE STORED IN THE USER
  -----------------------------------------------------------------------*/
  $candidate_religion_code = 0;
  $stmt =  $conn->prepare(
    "SELECT religion_id
    FROM candidatesInfoTBL 
    WHERE candidate_id=?;"
  );
  $stmt->bind_param("s", $candidate_id);
  $stmt->execute();

  $result = $stmt->get_result()->fetch_assoc();
  $candidate_religion_code = $result["religion_id"];
  /* ------------------------------------------------------------------- */

  $stmt =  $conn->prepare(
    "SELECT * 
    FROM religionTBL 
    WHERE religion_id=?;"
  );
  $stmt->bind_param("i", $candidate_religion_code);
  $stmt->execute();

  $result = $stmt->get_result()->fetch_assoc();
  echo "<option value='" . $result["religion_id"] . "'>";
  echo $result["religion"] . "</option>";
  $stmt->close();
  /* ------------------------------------------------------------------- */

  $stmt = $conn->prepare("SELECT * FROM religionTBL");
  $stmt->execute();
  $results = $stmt->get_result();
  while ($current_row = $results->fetch_assoc()) {
    if ($current_row["religion_id"] != $candidate_religion_code) {
      echo "<option value='" . $current_row["religion_id"] . "'>";
      echo $current_row["religion"] . "</option>";
    }
  }

  $stmt->close();
}

function isEditor()
{

  $conn = new mysqli(
    "remotemysql.com",
    "o9Dh9V4Tbr",
    "cEMBedVrx0",
    "o9Dh9V4Tbr",
    3306
  );

// preparation of prepared statement
$stmt = $conn->prepare("SELECT type FROM accTBL WHERE name=?");
$stmt->bind_param("s", $_COOKIE["acc_name"]);

// execution
$stmt->execute();
// result retrieval
$results = $stmt->get_result();
// should only have one result; No need to have a while iterator here
$user = $results->fetch_assoc();

if (empty($user) == FALSE)
    $acc_type = $user['type'];
else
    $acc_type = ''; //specify empty user


  //if account is editor
  if(strcmp($acc_type, 'editor') == 0 || strcmp($acc_type, 'admin') == 0 )
    return true;
  else
    return false;
 
}

function getHeader()
{
  if (array_key_exists("pos_id", $_GET)) {
    if (($_GET["pos_id"] == "P")) {

      echo "  <section class='hero is-danger'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for President</em>";
      echo "  </p>";
      echo "  </section>";
    } else if ($_GET["pos_id"] == "VP") {

      echo "  <section class='hero is-success'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for VP</em>";
      echo "  </p>";
      echo "  </section>";
    } else if ($_GET["pos_id"] == "S") {

      echo "  <section class='hero is-warning'>";
      echo "  <div class='hero-body'>";
      echo "  <p class='title' style='text-align: center;'>";
      echo "  <em>Candidates</em>";
      echo "  </p>";
      echo "  <p class='subtitle' style='text-align: center;'>";
      echo "  <em>Running for Senator</em>";
      echo "  </p>";
      echo "  </section>";
    } else {
      // IF POS_ID IS PRESENT BUT NOT ACCORDING TO VALID POS_IDs
      header("Location: Candidates.php?pos_id=P", true);
    }
  } else {
    // IF POS_ID IS ABSENT IN GENERAL
    header("Location: Candidates.php?pos_id=P", true);
  }
}
