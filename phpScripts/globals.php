<?php

/* 
Username: o9Dh9V4Tbr
Database name: o9Dh9V4Tbr
Password: cEMBedVrx0
Server: remotemysql.com
Port: 3306 
*/

// GLOBAL VARIABLE FOR DB
$DB_CREDENTIALS =
    [
        "user" => "o9Dh9V4Tbr",
        "pass" => "cEMBedVrx0",
        "db_name" => "o9Dh9V4Tbr",
        "server" => "remotemysql.com",
        "port" => 3306
    ];

$LOCALHOST_CREDENTIALS =
    [
        "user" => "root",
        "pass" => "",
        "db_name" => "temp_database",
        "server" => "localhost",
        "port" => 3306
    ];

function connectDB(array $db_credentials)
{
    return new mysqli(
        $db_credentials["server"],
        $db_credentials["user"],
        $db_credentials["pass"],
        $db_credentials["db_name"],
        $db_credentials["port"]
    );
}
