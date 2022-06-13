<?php
require_once 'globals.php';

$candidate_name = $_POST["candidate"];

$conn = connectDB($DB_CREDENTIALS);

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

if (array_key_exists("accomplishments", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET accomplishments_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["accomplishments"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("platform", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET platform_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["platform"], $candidate_id);
    $stmt->execute();
    $stmt->close();
}

if (array_key_exists("org", $_POST)) {
    $stmt = $conn->prepare(
        "UPDATE candidatesInfoTBL 
        SET org_txt=? 
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param("si", $_POST["org"], $candidate_id);
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
