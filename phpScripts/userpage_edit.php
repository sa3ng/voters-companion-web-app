<?php

require_once 'globals.php';

$conn = connectDB($DB_CREDENTIALS);

// Server-side validation prep
$stmt =  $conn->prepare(
    "SELECT acc_id
    FROM accTBL
    WHERE name = ?;"
);

$stmt->bind_param("s", $_COOKIE["acc_name"]);

$stmt->execute();


//server-side name validation
if (isset($_COOKIE["acc_name"])) {
    $result = $stmt->get_result();
    $fetchname = $result->fetch_assoc();
    if(!(empty($fetchname)))
    $user = $fetchname["acc_id"];
    else die();
}
$stmt->close();


// if script reaches this far, ok to do edits

if (isset($_POST["full_name"])) {
    $stmt =  $conn->prepare(
        "UPDATE accProfileTBL
        SET full_name=?
        WHERE acc_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["full_name"],
        $user
    );
    $stmt->execute();
}

if (isset($_POST["bio"])) {
    $stmt =  $conn->prepare(
        "UPDATE accProfileTBL
        SET bio=?
        WHERE acc_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["bio"],
        $user
    );
    $stmt->execute();
}

if (isset($_POST["user_tag"])) {
    $stmt =  $conn->prepare(
        "UPDATE accProfileTBL
        SET user_tag=?
        WHERE acc_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["user_tag"],
        $user
    );
    $stmt->execute();
}

if (isset($_POST["birthday"])) {
    $stmt =  $conn->prepare(
        "UPDATE accProfileTBL
        SET birthday=?
        WHERE acc_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["birthday"],
        $user
    );
    $stmt->execute();
}

$stmt->execute();
$stmt->close();

//-------------------------------------------------------------------------

echo "OK";
die();

/* 

formData.append("candidate_name", $(editModalCandidateName).val().toUpperCase());
formData.append("candidate_desc", $(editModalCandidateDescription).val());
formData.append("candidate_id", $(editModalHiddenID).val());

*/
