<?php

function fetchPostInfo($db_credentials, $info, $post_header){
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );

    //instantiate
    $acc_id = fetchAccId($db_credentials, $_COOKIE["acc_name"]);

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT ".$info." FROM postsTBL WHERE header=?");
    $stmt->bind_param("s",$post_header);

    // execution
    $stmt->execute();
    // result retrieval
    $results = $stmt->get_result();
    // should only have one result; No need to have a while iterator here
    $info_result = $results->fetch_assoc();

    if (empty($info_result))
        die;

    return $info_result[$info];
}


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
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = 1");
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
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = 1");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $post_ids = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_ids , $posts['post_id']);
            
        }
        
        return $post_ids;

        $conn->close();
        $stmt->close();
    }


    function fetchDates($db_credentials, $approved)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = $approved");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $post_dates = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_dates , $posts['date']);
            
        }
        
        return $post_dates;

        $conn->close();
        $stmt->close();
    }

    function fetchPendingPosts($db_credentials, $column){
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        $acc_id = fetchAccId($db_credentials, $_COOKIE["acc_name"]);

        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = 0 AND acc_id =".$acc_id);
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $post_headers = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_headers , $posts[$column]);
            
        }
        
        return $post_headers;

        $conn->close();
        $stmt->close();

    }

    function fetchLikes($db_credentials, $post_id)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
        
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT COUNT(post_id)
        FROM likesTBL
        WHERE post_id=?;");

        $stmt->bind_param("i", $post_id);
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //has only one value 
        $post_likes =  mysqli_fetch_assoc($results);

        

        if($post_likes == NULL)
            $post_likes = 0;
        
        return $post_likes['COUNT(post_id)'];

        $conn->close();
        $stmt->close();
    }


    function fetchPostAccID($db_credentials)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = 1");
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


    function createReply($db_credentials, $post_id){

        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        
        $message = $_POST['message-input'];
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name='" . $_COOKIE["acc_name"] ."' ");
        $stmt->execute();
        $result = $stmt->get_result();
        $name = $result->fetch_assoc();
    
        $stmt->close();
    
        $stmt2 = $conn->prepare("INSERT INTO postsTBL(acc_id,message, is_reply, is_reply_of) VALUES('" . $name["acc_id"] . "','". $message . "', 1 ,".$post_id.")");
        $stmt2->execute();
        $stmt2->close();
    
        $conn->close();
    
        header("Location:../phpPages/ForumPostPage.php");
    }

    function checkLikes($db_credentials, $column)
    {
        $conn = connectDB($db_credentials);

        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name=?");
        $stmt->bind_param("s",$_COOKIE["acc_name"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $name = $result->fetch_assoc();

        $stmt->close();

        $stmt2 = $conn->prepare("SELECT post_id FROM likesTBL WHERE acc_id=?");
        $stmt2->bind_param("i",$name["acc_id"]);
        $stmt2->execute();
        $results = $stmt2->get_result();

        $stmt2->close();

       
        
        //define arrayVariables as an array
        $like_array = array();

        //Fill up Arrays 
        while($likes = $results->fetch_assoc()){
            if(!is_null($likes))  
                array_push($like_array , $likes[$column]);  
        }
        
        return $like_array;

        $conn->close();
        echo "OK";
    }
    function fetchReplyElement($db_credentials, $post_id, $element){

        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 1 AND is_reply_of = ".$post_id);
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $reply_array = array();

        //Fill up Arrays 
        while($replies = mysqli_fetch_assoc($results)){
            array_push($reply_array , $replies[$element]);
            
        }
        
        return $reply_array;

        $conn->close();
        $stmt->close();

    }

    function rm_special_char($str) {

        //Remove "#","'" and ";" using str_replace() function
        
        $result = str_replace( array("'", ";"), '', $str);
        
        
        return $result;
        
    }

    function fetchNonApprovedPosts($db_credentials, $column){
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );


        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM postsTBL WHERE is_reply = 0 AND approved = 0");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        
        //define arrayVariables as an array
        $post_headers = array();

        //Fill up Arrays 
        while($posts = mysqli_fetch_assoc($results)){
            array_push($post_headers , $posts[$column]);
            
        }
        
        return $post_headers;

        $conn->close();
        $stmt->close();

    }
?>