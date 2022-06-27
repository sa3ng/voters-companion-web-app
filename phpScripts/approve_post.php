<?php
    require_once 'globals.php';

    $post_approval_header = $_POST['post_header'];

    $conn = new mysqli(
        $DB_CREDENTIALS["server"],
        $DB_CREDENTIALS["user"],
        $DB_CREDENTIALS["pass"],
        $DB_CREDENTIALS["db_name"],
        $DB_CREDENTIALS["port"]
    );

    // preparation of prepared statement
    $stmt = $conn->prepare("UPDATE postsTBL SET approved = 1 WHERE header = '". $post_approval_header."'");
    // execution
    $stmt->execute();

    header("Location: ../phpPages/ForumPage.php");


?>