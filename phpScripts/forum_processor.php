<?php

    function fetchHeaders($db_credentials)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $post_headers = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_headers , $posts['header']);
            
        }
        
        return $post_headers;

        $conn->close();
        $stmt->close();
    }



    function uploadPost($db_credentials, $acc_id, $header, $message, $is_reply){
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("INSERT INTO postsTBL(acc_id,header,message,is_reply) VALUES(". $acc_id .",'". $header ."','". $message ."',". $is_reply .")");

        // execution
        $stmt->execute();

        
        $conn->close();
        $stmt->close();
    }
?>