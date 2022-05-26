<?php
function isLoggedIn()
{
    if (array_key_exists("acc_id", $_COOKIE))
        return true;
    return false;
}

function selectSelfNameCookie()
{
    if (array_key_exists("acc_name", $_COOKIE)) {
        return $_COOKIE["acc_name"];
    }

    return "?";
}

/*
 function selectSelfName($db_credentials)
{
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT name FROM accTBL WHERE acc_id=?");
    $stmt->bind_param("s", $_COOKIE["acc_id"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    if (empty($user))
        die;

    return $user["name"];
} 
*/
