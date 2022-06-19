<?php

require_once 'globals.php';

$conn = connectDB($DB_CREDENTIALS);

// Server-side validation
$stmt =  $conn->prepare(
    "SELECT full_name
    FROM candidatesTBL;"
);
$stmt->execute();
//server-side name validation
if (isset($_POST["candidate_name"])) {
    $result = $stmt->get_result();
    while ($current_row = $result->fetch_assoc()) {
        if ($_POST["candidate_name"] == $current_row["full_name"]) {
            echo "NAME_IN_DB";
            die();
        }
    }
}
$stmt->close();

// if script reaches this far, ok to do edits

if (isset($_POST["candidate_name"])) {
    $stmt =  $conn->prepare(
        "UPDATE candidatesTBL 
        SET full_name=?
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["candidate_desc"],
        $_POST["candidate_id"]
    );
    $stmt->execute();
}

$stmt =  $conn->prepare(
    "UPDATE candidatesTBL 
        SET bio=?
        WHERE candidate_id = ?;"
);

$stmt->bind_param(
    "si",
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
