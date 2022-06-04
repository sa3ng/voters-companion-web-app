<?php
$name;
$num;
$pos;
$desc;


// SETTING VALUE TO AN EMPTY STRING
$name = $num = $pos = $desc = "";

$name = $_POST["c-cand-name"];
$num = $_POST["c-cand-num"];
$pos = $_POST["c-cand-pos"];
$desc = $_POST["c-cand-desc"];

// SHOULD VALIDATE FIRST STRING: NAME
$trm_name = "";
if ($trm_name = trim($name) == "")
    echo "BAD_NAME";
else {
    echo "OK";
}

// SHOULD CHECK FOR DUPLICATES IN DB: NUM AND NAME
