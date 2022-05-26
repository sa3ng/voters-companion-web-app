<?php

include_once '../phpScripts/globals.php';
require_once '../phpScripts/register_functions.php';

if (array_key_exists("REQUEST_METHOD", $_SERVER))
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        registerUser(
            $LOCALHOST_CREDENTIALS,
            [
                "email_register" => $_POST["email-register"],
                "user_register" => $_POST["user-register"],
                "pass_register" => $_POST["pass-register"],
            ],
            "user_table",
            "user_email",
            "user_name"
        );
    }
