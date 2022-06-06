<?php
    require '../phpScripts/globals.php';

    $conn = new mysqli(
        $DB_CREDENTIALS["server"],
        $DB_CREDENTIALS["user"],
        $DB_CREDENTIALS["pass"],
        $DB_CREDENTIALS["db_name"],
        $DB_CREDENTIALS["port"]
    );

    $header = $_POST['title'];
    $message = $_POST['message-input'];

    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name='" . $_COOKIE["acc_name"] ."' ");
    $stmt->execute();
    $result = $stmt->get_result();
    $name = $result->fetch_assoc();

    $stmt->close();

    $stmt2 = $conn->prepare("INSERT INTO postsTBL(acc_id,header,message, is_reply) VALUES('" . $name["acc_id"] . "','". $header ."','". $message . "', 0)");
    $stmt2->execute();
    $stmt2->close();

    $conn->close();

    header("Location:../phpPages/ForumPage.php");
    ?>