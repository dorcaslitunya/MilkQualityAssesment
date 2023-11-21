<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

defined("site") or define("site", $_SERVER['DOCUMENT_ROOT'] . "/");

$site_state = 1;

if ($site_state == 0) {
    if (!isset($_SESSION['email']) || $_SESSION['email'] == "") {
        // header("Location:/dashboard/welcome.php");
        // header("location:/under_maintenance.php");
    } else {
        // page under construction
        // header("location:/dashboard/under_maintenance.php");
    }
} else if ($site_state == 1) {
    if (!isset($_SESSION['email']) || $_SESSION['email'] == "") {
        header("Location:/welcome.php");
    } else {
        // echo "email is -> " . $_SESSION['email'];
    }
}