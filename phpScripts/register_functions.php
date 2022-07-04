<?php
require_once 'globals.php';
require_once 'usr_page_functions.php';

function registerUser($db_credentials, $user_credentials, $user_db_tbl, $email_column, $user_column, $acc_name)
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
        createProfileAccount($db_credentials, $conn, $acc_name);
        createAccountPreferences($db_credentials, $conn, $acc_name);
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


function createProfileAccount($db_credentials , mysqli $conn, $acc_name)
{
    $acc_id = fetchAccId($db_credentials, $acc_name);

    //default values - locals
    $user_tag = '@default';
    $full_name = '-- Please Edit Your Name --';
    $gender = 'Edit Gender';
    $political_label = 'Default Man';
    $bio = '-- Introduce yourself --';

    $stmt = $conn->prepare(
        "INSERT INTO accProfileTBL(acc_id, user_tag, full_name, gender, political_label, bio) 
        VALUES(?, ?, ?, ?, ?, ?);"
    );

    //Temporary default values
    $stmt->bind_param(
        "ssssss",
        $acc_id,
        $user_tag,
        $full_name,
        $gender,
        $political_label,
        $bio
    );

    $stmt->execute();
    $stmt->close();
}

function createAccountPreferences($db_credentials , mysqli $conn, $acc_name)
{
    $acc_id = fetchAccId($db_credentials, $acc_name);

    //default values - locals
    $default_candidate = 'ABSTAIN';
   

    $stmt = $conn->prepare(
        "INSERT INTO accCandidatesTBL(acc_id, president_id, vpresident_id,
         s1_id, s2_id, s3_id, s4_id, s5_id, s6_id, s7_id, s8_id, s9_id, s10_id, s11_id, s12_id) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"
    );

    //Temporary default values
    $stmt->bind_param(
        "sssssssssssssss",
        $acc_id,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate,
        $default_candidate
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
