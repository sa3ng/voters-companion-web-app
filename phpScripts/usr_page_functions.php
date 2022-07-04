<?php

require_once 'globals.php';


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

function fetchAccIdProfileTBL($db_credentials, $post_user)
{
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT acc_id FROM accProfileTBL WHERE user_tag=?");
    $stmt->bind_param("s", $post_user);

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


function fetchAccTBL($db_credentials, $column)
{
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT $column FROM accTBL WHERE name=?");
    $stmt->bind_param("s", $_COOKIE["acc_name"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    if (empty($user))
        die;

    return $user[$column];
} 

function isAdmin($db_credentials)
{
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT type FROM accTBL WHERE name=?");
    $stmt->bind_param("s", $_COOKIE["acc_name"]);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $user = $results->fetch_assoc();

    if (empty($user))
        die;

    
        if(strcmp($user["type"],"admin")  == 0)
            return true;
        else
            return false;
} 


function fetchPersonalInfo($db_credentials, $info, $acc_id){
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    //instantiate
    // $acc_id = fetchAccId($db_credentials);

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

function fetchCandidateNames($db_credentials, $position_id)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM candidatesTBL WHERE position_id ='".$position_id."'");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $candidate_names = array();

        //Fill up Arrays 
        while($names = mysqli_fetch_assoc($results)){
            array_push($candidate_names , $names['full_name']);
            
        }
        
        
        return $candidate_names;

        $conn->close();
        $stmt->close();
    }

function fetchPreferedNames($db_credentials, $column, $acc_id)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT $column FROM accCandidatesTBL WHERE acc_id = $acc_id");
        
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $candidate_names = array();

        //Fill up Arrays 
        while($names = mysqli_fetch_assoc($results)){
            array_push($candidate_names , $names[$column]);
            
        }
        
        return $candidate_names[0];

        $conn->close();
        $stmt->close();
    }

    function fetchPreferedSenators($db_credentials, $acc_id)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM accCandidatesTBL WHERE acc_id = $acc_id");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $candidate_names = array();

        //Fill up Arrays 
        while($names = mysqli_fetch_assoc($results)){
            array_push($candidate_names , $names['s1_id']);
            array_push($candidate_names , $names['s2_id']);
            array_push($candidate_names , $names['s3_id']);
            array_push($candidate_names , $names['s4_id']);
            array_push($candidate_names , $names['s5_id']);
            array_push($candidate_names , $names['s6_id']);
            array_push($candidate_names , $names['s7_id']);
            array_push($candidate_names , $names['s8_id']);
            array_push($candidate_names , $names['s9_id']);
            array_push($candidate_names , $names['s10_id']);
            array_push($candidate_names , $names['s11_id']);
            array_push($candidate_names , $names['s12_id']);
        }
        
        return $candidate_names;

        $conn->close();
        $stmt->close();
    }
