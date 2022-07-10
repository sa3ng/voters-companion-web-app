<?php  

// $sname = "remotemysql.com";
// $uname = "o9Dh9V4Tbr";
// $password = "cEMBedVrx0";
// $db_name = "o9Dh9V4Tbr";

$sname = "sql.freedb.tech";
$uname = "freedb_sa3ng";
$password = "yW"."$". "B6aXSJ8nZn#w";
$db_name = "freedb_votersAppDB";



$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}