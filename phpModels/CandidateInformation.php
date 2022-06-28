<?php
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
      $this->basic_info["image_url"] = $user["image_url"];

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
