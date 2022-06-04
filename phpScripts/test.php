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

echo json_encode([$name, $num, $pos, $desc]);
