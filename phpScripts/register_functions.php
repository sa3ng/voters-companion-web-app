<?php
require_once 'globals.php';

function registerUser($db_credentials, $user_credentials, $user_db_tbl, $email_column, $user_column)
{
    $conn = connectDB($db_credentials);

    if (checkForSimilarEmail($conn, $user_credentials, $user_db_tbl, $email_column)) {
        // displayAlertAndRedirect("EMAIL IS ALREADY TAKEN!");
        echo "EMAIL";
    } else if (checkForSimilarUsername($conn, $user_credentials, $user_db_tbl, $user_column)) {
        // displayAlertAndRedirect("USERNAME IS ALREADY TAKEN");
        echo "USERNAME";
    } else {
        createAccount($conn, $user_credentials, $user_db_tbl);
        // header("index.php"); //Home page
        echo "OK";
    }

    $conn->close();
}

// HELPER FUNCTIONS
function checkForSimilarEmail(mysqli $conn, $user_credentials, $target_tbl, $target_column)
{
    $stmt = $conn->prepare("SELECT * FROM " .  $target_tbl . " WHERE " . $target_column . "=?");
    $stmt->bind_param("s", $user_credentials["email_register"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    $stmt->close();

    // If no users were returned, EMAIL is OK
    if (empty($user)) {
        return false;
    }

    return true;
}

function checkForSimilarUsername($conn, $user_credentials, $target_tbl, $target_column)
{
    $stmt = $conn->prepare("SELECT * FROM " .  $target_tbl . " WHERE " . $target_column . "=?");
    $stmt->bind_param("s", $user_credentials["user_register"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    $stmt->close();

    // If no users were returned, USERNAME is OK
    if (empty($user)) {
        return false;
    }

    return true;
}

function createAccount(mysqli $conn, array $user_credentials, $user_db_tbl)
{
    $default_user_type = "user";
    $stmt = $conn->prepare(
        "INSERT INTO " . $user_db_tbl . "(name, pass, email, type) VALUES(?, ?, ?, ?);"
    );
    $stmt->bind_param(
        "ssss",
        $user_credentials["user_register"],
        $user_credentials["pass_register"],
        $user_credentials["email_register"],
        $default_user_type
    );

    $stmt->execute();

    $stmt->close();
}

function displayAlertAndRedirect($message)
{
    echo
    "<script> 
        alert('" . $message . "');" .
        "</script>";
}
