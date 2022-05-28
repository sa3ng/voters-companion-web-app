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
