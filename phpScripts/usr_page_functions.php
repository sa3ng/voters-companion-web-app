<?php

require_once '../phpScripts/globals.php';


function isLoggedIn()
{
    if (array_key_exists("acc_name", $_COOKIE))
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


function fetchAccId($db_credentials)
{
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name=?");
    $stmt->bind_param("s", $_COOKIE["acc_name"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    if (empty($user))
        die;

    return $user["acc_id"];
} 

function fetchPersonalInfo($db_credentials, $info){
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    //instantiate
    $acc_id = fetchAccId($db_credentials);

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT ".$info." FROM accProfileTBL WHERE acc_id=?");
    $stmt->bind_param("s",$acc_id);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    if (empty($user))
        die;

    return $user[$info];
}

function setAccImageURL(){
    include 'db_conn.php';

    $sql = "SELECT image_url FROM accProfileTBL WHERE acc_id = 1";
    $res = mysqli_query($conn,  $sql);

    
    $images = mysqli_fetch_assoc($res);

    return $images['images_url'];
}

