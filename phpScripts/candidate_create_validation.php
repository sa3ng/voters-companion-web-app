<?php
include_once '../phpScripts/globals.php';

$name;
$num;
$pos;
$desc;


// SETTING VALUE TO AN EMPTY STRING
$name = $num = $pos = $desc = "";

$name = $_POST["c-cand-name"];
$num = $_POST["c-cand-num"];
$pos = $_POST["c-cand-pos"];
$desc = $_POST["c-cand-desc"];

// SHOULD VALIDATE FIRST STRING: NAME
$trm_name = "";
if ($trm_name = trim($name) == "") {
  echo "BAD_NAME";
  die();
}

// VALIDATE ITEM IN DB : NAME
// VALIDATE ITEM IN DB : POS_NUM
$conn = new mysqli(
  $DB_CREDENTIALS["server"],
  $DB_CREDENTIALS["user"],
  $DB_CREDENTIALS["pass"],
  $DB_CREDENTIALS["db_name"],
  $DB_CREDENTIALS["port"]
);

$stmt = $conn->prepare("SELECT 
candidatesTBL.full_name, candidatesTBL.position_id, candidatesInfoTBL.candidate_num 
FROM candidatesTBL LEFT JOIN candidatesInfoTBL 
ON candidatesTBL.candidate_id = candidatesInfoTBL.candidate_id;");

$stmt->execute();

$results = $stmt->get_result();
// CHECK HERE IF THERE IS A SIMLARITY IN : USER INPUT OF POS_ID AND POS_NUM FROM DB
while ($current_row = $results->fetch_assoc()) {

  if ($name == $current_row["full_name"]) {
    echo "NAME_IN_DB";
    die();
  }

  if ($pos == $current_row["position_id"] && $num == $current_row["candidate_num"]) {
    echo "CANDIDATE_NUM_EXISTS_IN_POSITION";
    die();
  }
}
