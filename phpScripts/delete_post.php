<?php

require_once 'globals.php';

$post_approval_header = $_POST['post_approval_header'];

$conn = new mysqli(
    $DB_CREDENTIALS["server"],
    $DB_CREDENTIALS["user"],
    $DB_CREDENTIALS["pass"],
    $DB_CREDENTIALS["db_name"],
    $DB_CREDENTIALS["port"]
);

// preparation of prepared statement
$stmt = $conn->prepare("DELETE FROM postsTBL WHERE header = '". $post_approval_header."'");
// execution
$stmt->execute();

header("Location: ../phpPages/ForumPage.php");

?>