<?php

defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']. "/");

//--------- display all errors --------- 
include_once site . "/dashboard/error_toggle.php";
// ----------- error display ------------

session_start();

print_r($_SESSION);

?>