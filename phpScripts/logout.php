<?php

require_once 'usr_page_functions.php';

function logOut()
{
    setcookie("acc_id", "", time() - 3600, "/");
    setcookie("acc_name", "", time() - 3600, "/");
}

if (isLoggedIn()) {
    logOut();
    header("Location: ../phpPages/usrPage.php");
    die();
}
