<?php
    $conn = new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );
    //$acc_id = $_POST[];
    $header = $_POST['title'];
    $message = $_POST['message-input'];

    // preparation of prepared statement
    $stmt = $conn->prepare("INSERT INTO postsTBL(acc_id,header,message, is_reply) VALUES(2,". $header ."','". $message . "',' 0)");

    // execution
    $stmt->execute();

    
    $conn->close();
    $stmt->close();
?>