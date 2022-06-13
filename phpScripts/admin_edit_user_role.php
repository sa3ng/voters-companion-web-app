<?php
require_once 'globals.php';

if (array_key_exists("REQUEST_METHOD", $_SERVER)) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $conn = connectDB($DB_CREDENTIALS);

        $stmt = $conn->prepare(
            "UPDATE accTBL
            SET type=?
            WHERE name=?;"
        );
        $stmt->bind_param("ss", $_POST['role'], $_POST['user']);
        $stmt->execute();
        if ($stmt->errno == 0) {
            echo "OK";
        } else {
            echo "NOT_SUBMITTED";
        }
        $stmt->close();
        $conn->close();
    }
}
