<?php
defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']. "/");
// --------- display all errors --------- 
include_once site . "/dashboard/error_toggle.php";
// ----------- error display ------------


$host = "localhost";
$dbname = "login_db";
$username = "milk";
$password = "home";


$mysqli = new mysqli(hostname:$host,
                    username: $username,
                    password: $password,
                    database: $dbname);

if($mysqli->connect_errno) {
    die("Connection error:" . $mysqli->connect_error);
}

return $mysqli;