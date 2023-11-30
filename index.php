<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']."/");
defined("page_title") or define("page_title", "Welcome");
defined("site_title") or define("site_title", "MilkTester");

// --------- display all errors --------- 
include_once site . "/dashboard/error_toggle.php";
// ----------- error display ------------

// --------- start session ---------
// include_once site . "/dashboard/sessions.php";
// --------- session ---------

//include site . "/overview.php";

include site . "/dashboard/SignUp/signup.html";

//include site . "dashboard/SignInUp/SignInUp.php";
