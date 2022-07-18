<?php
    require '../phpScripts/globals.php';
    require '../phpScripts/forum_processor.php';
    
    $is_reply = (int) $_POST['is_reply'];


    if($is_reply == 1){
        $post_id = $_POST['post_id'];
        $conn = new mysqli(
            $DB_CREDENTIALS["server"],
            $DB_CREDENTIALS["user"],
            $DB_CREDENTIALS["pass"],
            $DB_CREDENTIALS["db_name"],
            $DB_CREDENTIALS["port"]
        );
    
        
        $message_string = $_POST['message-input'];
        $message = rm_special_char($message_string);
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name='" . $_COOKIE["acc_name"] ."' ");
        $stmt->execute();
        $result = $stmt->get_result();
        $name = $result->fetch_assoc();
    
        $stmt->close();
    
        $stmt2 = $conn->prepare("INSERT INTO postsTBL(acc_id,message, is_reply, is_reply_of, likes, approved, date) VALUES('" . $name["acc_id"] . "','". $message . "', 1 ,".$post_id.", 0,1, DATE_FORMAT(NOW(), '%M %d %Y'))");
        $stmt2->execute();
        $stmt2->close();
    
        $conn->close();
    
        header("Location:../phpPages/ForumPage.php");

    }
    else{


    $conn = new mysqli(
        $DB_CREDENTIALS["server"],
        $DB_CREDENTIALS["user"],
        $DB_CREDENTIALS["pass"],
        $DB_CREDENTIALS["db_name"],
        $DB_CREDENTIALS["port"]
    );

    $header_string = $_POST['title'];
    $message_string = $_POST['message-input'];
    
    $header = rm_special_char($header_string);
    $message = rm_special_char($message_string);


    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name='" . $_COOKIE["acc_name"] ."' ");
    $stmt->execute();
    $result = $stmt->get_result();
    $name = $result->fetch_assoc();

    $stmt->close();

    $stmt2 = $conn->prepare("INSERT INTO postsTBL(acc_id,header,message, is_reply, likes, approved, date) VALUES('" . $name["acc_id"] . "','". $header ."','". $message . "', 0, 0,0, DATE_FORMAT(NOW(), '%M %d %Y'))");
    $stmt2->execute();
    $stmt2->close();

    $conn->close();

    header("Location:../phpPages/ForumPage.php");

    }
    ?>