<?php
require_once 'globals.php';

if (array_key_exists("REQUST_METHOD", $_SERVER)) {
    header("Location: ../phpPages/Candidates.php", true);
    die();
}

if (array_key_exists("candidate_name", $_POST)) {
    $conn = connectDB($DB_CREDENTIALS);
    $stmt = $conn->prepare(
        "SELECT candidate_id 
        FROM candidatesTBL
        WHERE full_name = ?"
    );
    $stmt->bind_param("s", $_POST["candidate_name"]);
    $stmt->execute();
    $candidate_id = $stmt->get_result()->fetch_assoc()["candidate_id"];

    // TO REMOVE THE FOREIGN KEY CONSTRANT THAT PREVENTS DELETION
    $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS = 0;");
    $stmt->execute();

    $stmt = $conn->prepare(
        "DELETE FROM candidatesTBL 
        WHERE candidate_id=?;"
    );
    $stmt->bind_param("i", $candidate_id);
    $stmt->execute();
    $stmt = $conn->prepare(
        "DELETE FROM candidatesInfoTBL 
        WHERE candidate_id=?;"
    );
    $stmt->bind_param("i", $candidate_id);
    $stmt->execute();

    // TO ADD BACK THE FOREIGN KEY CONSTRANT THAT PREVENTS DELETION
    $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS = 1;");
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
