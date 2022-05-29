<?php
// class to be utilized by fetchCandidates()
class CandidateOverviewClass
{
  private $name;
  private $candidate_id;

  // CONSTRUCTORS
  function __construct($name, $candidate_id)
  {
    $this->name = $name;
    $this->candidate_id = $candidate_id;
  }

  // GETTERS
  function getName()
  {
    return $this->name;
  }

  function getCandidateId()
  {
    return $this->candidate_id;
  }
}

/* 

Candidate info model that will store the extracted information

*/
class CandidateInformationClass
{
  private $name;
  private $political_party;
  private $birthday;
  private $birthplace;
  private $religion;

  // DEFAULT CONSTRUCTOR INTIALIZES CLASS MEMBERS WITH EMPTY STRINGS
  function __construct()
  {
    $this->name = "";
    $this->political_party = "";
    $this->birthday = "";
    $this->birthplace = "";
    $this->religion = "";
  }

  // SETTERS
  function setName($name)
  {
    $this->name = $name;
  }

  function setPolParty($political_party)
  {
    $this->political_party = $political_party;
  }

  function setBirthday($birthday)
  {
    $this->birthday = $birthday;
  }

  function setBirthPlace($birthplace)
  {
    $this->birthplace = $birthplace;
  }

  function setReligion($religion)
  {
    $this->religion = $religion;
  }

  // GETTERS
  function getName($name)
  {
    return $this->name;
  }

  function getPolParty()
  {
    return $this->political_party;
  }

  function getBirthday()
  {
    return $this->birthday;
  }

  function getBirthplace()
  {
    return $this->birthplace;
  }

  function getReligion()
  {
    return $this->religion;
  }
}

function fetchCandidates($db_credentials)
{
  $conn = new mysqli(
    $db_credentials["server"],
    $db_credentials["user"],
    $db_credentials["pass"],
    $db_credentials["db_name"],
    $db_credentials["port"]
  );

  // preparation of prepared statement
  $stmt = $conn->prepare("SELECT * FROM candidatesTBL");
  // execution
  $stmt->execute();
  // result retrieval
  $results = $stmt->get_result();
  //define CandidateName as an array
  $candidates_arr = [];

  //Fill up Candidate Names
  while ($current_row = $results->fetch_assoc()) {
    array_push($candidates_arr, new CandidateOverviewClass($current_row["full_name"], $current_row["candidate_id"]));
  }

  $conn->close();
  $stmt->close();

  return $candidates_arr;
}

function displayCandidates($db_credentials)
{


  $candidate_objs = fetchCandidates($db_credentials);

  $candidates_displayed = 0;
  $candidates_max = sizeof($candidate_objs);
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

      echo "  <div class='column'>";
      echo "    <div class='card hovereffect'>";
      echo "      <div class='card-content'>";
      echo "        <div class='media'>";
      echo "          <div class='media-left'>";
      echo "            <figure class='image is-128x128'>
                          <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                        </figure>";
      echo "          </div>";
      echo "          <div class='media-content'>";
      echo "            <p class ='title'>" . $candidate_objs[$candidates_displayed]->getName() . "</p>";
      echo "            <p class='subtitle'> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam 
                        sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                        </p>";
      echo "          </div>";
      echo "        </div>";
      echo "      <footer class='card-footer'>";
      echo "        <p class='card-footer-item'>";
      echo "        <span>";
      echo "          <a href='CandidatePage.php?cid=" . $candidate_objs[$candidates_displayed]->getCandidateId() . "'>Learn More</a>";
      echo "        </span>";
      echo "        </p>";
      echo "      <footer>";
      echo "      </div>";
      echo "    </div>";
      echo "  </div>";

      $candidates_displayed++;
    }
    /* 
    PRINT NEXT CARD
    */
    if (($candidates_displayed % 2 != 0) && $candidates_displayed < $candidates_max) {
      echo "  <div class='column'>";
      echo "    <div class='card hovereffect'>";
      echo "      <div class='card-content'>";
      echo "        <div class='media'>";
      echo "          <div class='media-left'>";
      echo "            <figure class='image is-128x128'>
                          <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                        </figure>";
      echo "          </div>";
      echo "          <div class='media-content'>";
      echo "            <p class ='title'>" . $candidate_objs[$candidates_displayed]->getName() . "</p>";
      echo "            <p class='subtitle'> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam 
                        sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                        </p>";
      echo "          </div>";
      echo "        </div>";
      echo "      <footer class='card-footer'>";
      echo "        <p class='card-footer-item'>";
      echo "        <span>";
      echo "          <a href='CandidatePage.php?cid=" . $candidate_objs[$candidates_displayed]->getCandidateId() . "'>Learn More</a>";
      echo "        </span>";
      echo "        </p>";
      echo "      <footer>";
      echo "      </div>";
      echo "    </div>";
      echo "  </div>";

      $candidates_displayed++;
    }

    if ($end_current_row) {
      // BASE CONTAINER END TAG
      echo "</div>";
      $end_current_row = false;
    }
  }
}

// CANDIDATE PAGE PROPER FUNCTIONS

/* 
this function should check if the user has passed the request to the server
*/


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

function getCandidateInfo($candidate_id, $db_credentials)
{
  $conn = new mysqli(
    $db_credentials["server"],
    $db_credentials["user"],
    $db_credentials["pass"],
    $db_credentials["db_name"],
    $db_credentials["port"]
  );

  $candidate_info = new CandidateInformationClass();
  $info_table = "candidatesInfoTBL";
  $name_table = "candidatesTBL";

  $candidate_info->setBirthday(getCandidateBirthday(
    $conn,
    $candidate_id,
    "birthday",
    $info_table
  ));

  $candidate_info->setBirthPlace(getCandidateBirthplace(
    $conn,
    $candidate_id,
    "birthplace",
    $info_table
  ));

  $candidate_info->setPolParty(getCandidatePoliticalParty(
    $conn,
    $candidate_id,
    "political_party",
    $info_table
  ));

  $candidate_info->setReligion(getCandidateBirthday(
    $conn,
    $candidate_id,
    "religion",
    $info_table
  ));

  $candidate_info->setName(getCandidateName(
    $conn,
    $candidate_id,
    "full_name",
    $name_table
  ));


  return $candidate_info;
}

/* 
HELPER METHODS FOR THE getCandidateInfo()
IT IS IMPORTANT TO NOTE THAT THESE SHOULD USE AN ACITVE CONNECTION TOWARDS
A DATABASE AND THESE FUNCTIONS DO NOT CLOSE THE SQLi CONNECTION IN ANY MANNER 
 */

function getCandidateBirthday(
  $sqli_conn,
  $candidate_id,
  $birthday_column,
  $target_tbl
) {
}

function getCandidateBirthplace(
  $sqli_conn,
  $candidate_id,
  $birthplace_column,
  $target_tbl
) {
}

function getCandidatePoliticalParty(
  $sqli_conn,
  $candidate_id,
  $political_party_column,
  $target_tbl
) {
}

function getCandidateNum(
  $sqli_conn,
  $candidate_id,
  $political_party_column,
  $target_tbl
) {
}

function getCandidateName(
  $sqli_conn,
  $candidate_id,
  $name_column,
  $target_tbl
) {
}
