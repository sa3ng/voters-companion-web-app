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

    function fetchLikes($db_credentials)
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
        $post_likes = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_likes , $posts['likes']);
            
        }
        
        return $post_likes;

        $conn->close();
        $stmt->close();
    }

    function fetchIDs($db_credentials)
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
        $post_ids = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_ids , $posts['acc_id']);
            
        }
        
        return $post_ids;

        $conn->close();
        $stmt->close();
    }

    function fetchTags($db_credentials, $acc_id_array, $index)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT user_tag FROM accProfileTBL WHERE acc_id=?");
        $acc_id_array_index = $acc_id_array[$index];
        $stmt->bind_param("s", $acc_id_array_index);

        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $user_tag_array = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($user_tag_array , $posts['user_tag']);
            
        }
        
        return $user_tag_array;

        $conn->close();
        $stmt->close();
    }

?>