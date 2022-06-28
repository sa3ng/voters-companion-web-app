<?php
    require '../phpScripts/globals.php';
    require '../phpScripts/forum_processor.php';
    require_once '../phpScripts/usr_page_functions.php';

    //variables
    $acc_id = fetchAccId($DB_CREDENTIALS);
    $pres_id = $_POST["president_id_input"];
    $vpres_id = $_POST["v_president_id_input"];
    $s1_id = $_POST["sen1_id_input"];
    $s2_id = $_POST["sen2_id_input"];
    $s3_id = $_POST["sen3_id_input"];
    $s4_id = $_POST["sen4_id_input"];
    $s5_id = $_POST["sen5_id_input"];
    $s6_id = $_POST["sen6_id_input"];
    $s7_id = $_POST["sen7_id_input"];
    $s8_id = $_POST["sen8_id_input"];
    $s9_id = $_POST["sen9_id_input"];
    $s10_id = $_POST["sen10_id_input"];
    $s11_id = $_POST["sen11_id_input"];
    $s12_id = $_POST["sen12_id_input"];

  $conn = new mysqli(
        $DB_CREDENTIALS["server"],
        $DB_CREDENTIALS["user"],
        $DB_CREDENTIALS["pass"],
        $DB_CREDENTIALS["db_name"],
        $DB_CREDENTIALS["port"]
    );
    
    // preparation of prepared statement
    $stmt = $conn->prepare("INSERT INTO accCandidatesTBL VALUES ('$acc_id', '$pres_id', '$vpres_id', '$s1_id', '$s2_id', '$s3_id', '$s4_id', '$s5_id', '$s6_id', '$s7_id', '$s8_id', '$s9_id', '$s10_id', '$s11_id', '$s12_id')");
    $stmt->execute();
    $stmt->close();

    $conn->close();

    echo $pres_id;
    echo $vpres_id;
    //header("Location:../phpPages/ForumPage.php");
    ?>