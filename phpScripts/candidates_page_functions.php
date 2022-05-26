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
  $candidate_names = fetchCandidates($db_credentials);

  $num_of_candidates = 1;

  foreach ($candidate_names as $names) {
    // TODO : REFACTOR THIS
    if (!($num_of_candidates % 2 == 0) || $num_of_candidates == 1) {
      echo "
                    <div class='columns'>
                    <div class='column'>
                     <div class='card hovereffect'>
                       <div class='card-content'>
                         <div class='media'>
                         <div class='media-left'>
                         <figure class='image is-128x128'>
                           <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                         </figure>
                       </div>
                       <div class='media-content'>
                       "
        . "<p class ='title'>" . $candidate_names[$num_of_candidates - 1] . "</p>" .
        "
                         <p class='subtitle'>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                         </p>
                         </div>
                       </div>
                       <footer class='card-footer'>
                         <p class='card-footer-item'>
                           <span>
                            <a href='CandidatePage.html'>Learn More</a>
                           </span>
                         </p>
                       </footer>
                       </div>
                     </div>
                     </div>
                     ";
    } else {
      echo "
                    <div class='column'>
                     <div class='card hovereffect'>
                       <div class='card-content'>
                         <div class='media'>
                         <div class='media-left'>
                         <figure class='image is-128x128'>
                           <img class='is-rounded' src='https://i.pinimg.com/originals/2a/3a/fe/2a3afea3b703dba502ae62b54e069f12.jpg'>
                         </figure>
                       </div>
                       <div class='media-content'>
                       "
        . "<p class ='title'>" . $candidate_names[$num_of_candidates - 1] . "</p>" .
        "
                         <p class='subtitle'>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit quibusdam iste nam, dolorem ullam nulla, ratione saepe ipsam sequi a eius quos necessitatibus sed nesciunt vero corporis natus voluptatum.
                         </p>
                         </div>
                       </div>
                       <footer class='card-footer'>
                         <p class='card-footer-item'>
                           <span>
                            <a href='CandidatePage.html'>Learn More</a>
                           </span>
                         </p>
                       </footer>
                       </div>
                     </div>
                     </div>
                     </div> 
                     ";
    };


    $num_of_candidates += 1;
  }
}
