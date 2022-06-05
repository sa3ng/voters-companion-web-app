<?php
    require '../phpScripts/globals.php';

    $conn = new mysqli(
        $DB_CREDENTIALS["server"],
        $DB_CREDENTIALS["user"],
        $DB_CREDENTIALS["pass"],
        $DB_CREDENTIALS["db_name"],
        $DB_CREDENTIALS["port"]
    );
    //$acc_id = $_POST[];
    $header = $_POST['title'];
    $message = $_POST['message-input'];

    // preparation of prepared statement
    $stmt = $conn->prepare("INSERT INTO postsTBL(acc_id,header,message, is_reply) VALUES(2,'". $header ."','". $message . "', 0)");

    // execution
    $stmt->execute();

    
    $conn->close();
    $stmt->close();
?>