<?php

require_once 'globals.php';

$conn = connectDB($DB_CREDENTIALS);

// Server-side validation
$stmt =  $conn->prepare(
    "SELECT full_name
    FROM candidatesTBL;"
);
$stmt->execute();

$result = $stmt->get_result();
while ($current_row = $result->fetch_assoc()) {
    if ($_POST["candidate_name"] == $current_row["full_name"]) {
        echo "NAME_IN_DB";
        die();
    }
}

// if script reaches this far, ok to do edits

$stmt =  $conn->prepare(
    "UPDATE candidatesTBL 
    SET full_name=?, bio=?
    WHERE candidate_id = ?;"
);

$stmt->bind_param(
    "ssi",
    $_POST["candidate_name"],
    $_POST["candidate_desc"],
    $_POST["candidate_id"]
);
$stmt->execute();

$stmt->close();

echo "OK";
die();

/* 

formData.append("candidate_name", $(editModalCandidateName).val().toUpperCase());
formData.append("candidate_desc", $(editModalCandidateDescription).val());
formData.append("candidate_id", $(editModalHiddenID).val());

*/
