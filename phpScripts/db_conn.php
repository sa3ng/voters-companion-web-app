<?php  

$sname = "remotemysql.com";
$uname = "o9Dh9V4Tbr";
$password = "cEMBedVrx0";
$db_name = "o9Dh9V4Tbr";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}