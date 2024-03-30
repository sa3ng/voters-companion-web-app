<?php
  require_once 'globals.php';

  $conn = connectDB($DB_CREDENTIALS);
    
    // preparation of prepared statement
    $stmt = $conn->prepare("SELECT acc_id FROM accTBL WHERE name=?");
    $stmt->bind_param("s",$_COOKIE["acc_name"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $name = $result->fetch_assoc();
    
    $stmt->close();
    
    $stmt2 = $conn->prepare("DELETE FROM likesTBL WHERE acc_id=? AND post_id=?");
    $stmt2->bind_param("ii",$name["acc_id"], $_POST["post_id"]);
    $stmt2->execute();
    $stmt2->close();
    
    $conn->close();
    echo "OK";
?>