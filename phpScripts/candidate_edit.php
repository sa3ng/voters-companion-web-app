<?php
require_once 'globals.php';

$candidate_name = $_POST["candidate"];

$conn = new mysqli(
    $DB_CREDENTIALS["server"],
    $DB_CREDENTIALS["user"],
    $DB_CREDENTIALS["pass"],
    $DB_CREDENTIALS["db_name"],
    $DB_CREDENTIALS["port"]
);

$candidate_id;
$stmt =  $conn->prepare(
    "SELECT * 
    FROM candidatesTBL 
    WHERE full_name=?;"
);
$stmt->bind_param("s", $candidate_name);
$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();
$candidate_id = $result["candidate_id"];
$stmt->close();

if (array_key_exists("birthday", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET birthday=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["birthday"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("birthplace", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET birthplace=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["birthplace"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("marital", $_POST)) {
    // :)
}

if (array_key_exists("education", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET education_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["education"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("work", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET experience_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["work"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("criminal", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET criminal_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["criminal"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("religion", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET religion_id=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["religion"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
echo "OK";
die();
