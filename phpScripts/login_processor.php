<?php
require_once '../phpScripts/globals.php';
require_once '../phpScripts/login_functions.php';

// AJAX PAYLOAD TO BE SENT HERE

// value to hold the changes for returning the response
$response_ajax = [
    "email_error" => 0,
    "pass_error" => 0
];

if (array_key_exists("REQUEST_METHOD", $_SERVER)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (checkConnection($LOCALHOST_CREDENTIALS)) {
            $raw_value = queryAccount(
                $LOCALHOST_CREDENTIALS,
                // array with POST login credentials
                [
                    "email" => $_POST["email-input"],
                    "pass" => $_POST["pass-input"]
                ],
                "user_table",
                "user_email"
            );

            if ($raw_value == -1) {
                $response_ajax["email_error"] = 1;
            } else if ($raw_value == -2) {
                $response_ajax["pass_error"] = 1;
            }
        } else {
            // SENT REQUEST BUT NOT POST REQUEST
            return -4;
        }
    }
} else {
    // ARRIVED HERE WITHOUT REQUEST
    header("Location: ../phpPages/index.php");
    die("ARRIVED HERE WITHOUT REQUEST");
    return -3;
}

$out = json_encode($response_ajax);

// RESPONSE OUTPUT TO AJAX
echo $out;
