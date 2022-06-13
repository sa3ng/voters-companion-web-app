<script src='../resources/js/ckeditors.js'></script>
<?php
// class to be utilized by fetchCandidates()

use LDAP\Result;

class CandidateOverviewClass
{
  private $name;
  private $candidate_id;
  private $description;

  // CONSTRUCTORS
  function __construct($name, $candidate_id, $description)
  {
    $this->name = $name;
    $this->candidate_id = $candidate_id;
    $this->description = $description;
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

  function getDescription()
  {
    return $this->description;
  }
}

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
    array_push($candidates_arr, new CandidateOverviewClass($current_row["full_name"], $current_row["candidate_id"], $current_row["bio"]));
  }

  $conn->close();
  $stmt->close();

  return $candidates_arr;
}

function displayCandidates($db_credentials, $pos_id)
{


  $candidate_objs = fetchCandidates($db_credentials, $pos_id);

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
      echo "            <button class='button is-small is-info js-modal-trigger' data-target='modal-js-edit'>Edit Info</button>";        
      echo "            <p class='title'>" . $candidate_objs[$candidates_displayed]->getName() . "</p>";
      echo "            <p class='subtitle'>" . $candidate_objs[$candidates_displayed]->getDescription() . "</p>";
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
      echo "            <button class='button is-small is-info js-modal-trigger' data-target='modal-js-edit'>Edit Info</button>";        
      echo "            <p class='title'>" . $candidate_objs[$candidates_displayed]->getName() . "</p>";
      echo "            <p class='subtitle'>" . $candidate_objs[$candidates_displayed]->getDescription() . "</p>";
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
  return true;
}

/* 
Candidate info model that will store the:
  - extracted information 
  - methods for information extraction
*/
class CandidateInformationClass
{
  private $conn = null;
  private $candidate_id;
  /*
  candidate_id int(11) AI PK 
  full_name varchar(100) 
  position_id varchar(50) 
  bio text
   */
  private $basic_info = [];

  /*
  candidate_id int(11) 
  candidate_num int(11) 
  political_party varchar(300) 
  birthday varchar(50) 
  birthplace varchar(100) 
  religion_id int(11) 
  education_txt text 
  experience_txt text 
  criminal_txt text 
  advocacies_txt text 
   */
  private $extra_info = [];

  public function __construct(mysqli $conn = null, $candidate_id)
  {
    $this->conn = $conn;
    $this->candidate_id = $candidate_id;
  }

  public function setConnection(mysqli $conn)
  {
    $this->conn = $conn;
  }

  public function closeConnection()
  {
    $this->conn->close();
    $this->conn = null;
  }

  public function validateCandidate()
  {
    $stmt = $this->conn->prepare("SELECT * FROM candidatesTBL
      WHERE candidate_id = ?;");
    $stmt->bind_param("i", $this->candidate_id);
    $stmt->execute();

    $results = $stmt->get_result();
    $user = $results->fetch_assoc();
    if ($user) {
      $user = null;
      return true;
    }

    return false;
  }

  public function fetchInfo()
  {
    $stmt = $this->conn->prepare("SELECT * FROM candidatesTBL
    WHERE candidate_id = ?;");
    $stmt->bind_param("i", $this->candidate_id);
    $stmt->execute();

    $results = $stmt->get_result();
    $user = $results->fetch_assoc();
    if ($user) {
      $this->basic_info["candidate_id"] = $user["candidate_id"];
      $this->basic_info["full_name"] = $user["full_name"];
      $this->basic_info["position_id"] = $user["position_id"];
      $this->basic_info["bio"] = $user["bio"];

      $user = null;
    }

    $stmt = $this->conn->prepare("SELECT * FROM candidatesInfoTBL
    WHERE candidate_id = ?;");
    $stmt->bind_param("i", $this->candidate_id);
    $stmt->execute();

    $results = $stmt->get_result();
    $user = $results->fetch_assoc();
    if ($user) {
      $this->extra_info["candidate_id"] = $user["candidate_id"];
      $this->extra_info["candidate_num"] = $user["candidate_num"];
      $this->extra_info["political_party"] = $user["political_party"];
      $this->extra_info["birthday"] = $user["birthday"];
      $this->extra_info["birthplace"] = $user["birthplace"];
      $this->extra_info["education_txt"] = $user["education_txt"];
      $this->extra_info["experience_txt"] = $user["experience_txt"];
      $this->extra_info["criminal_txt"] = $user["criminal_txt"];
      $this->extra_info["advocacies_txt"] = $user["advocacies_txt"];
      $this->extra_info["accomplishments_txt"] = $user["accomplishments_txt"];
      $this->extra_info["org_txt"] = $user["org_txt"];
      $this->extra_info["platform_txt"] = $user["platform_txt"];

      // GET THE STRING LITERAL INSTEAD OF THE REL_CODE ASSOC WITH CANDID
      $this->extra_info["religion_id"] = $user["religion_id"];

      $stmt = $this->conn->prepare("SELECT religion FROM religionTBL
      WHERE religion_id = ?;");
      $stmt->bind_param("i", $this->extra_info["religion_id"]);
      $stmt->execute();

      $results = $stmt->get_result();
      $religion = $results->fetch_assoc();

      $this->extra_info["religion_id"] = $religion["religion"];

      // END
      $user = null;
    }

    $stmt->close();
  }

  public function getBasicInfo()
  {
    return $this->basic_info;
  }

  public function getExtraInfo()
  {
    return $this->extra_info;
  }
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
