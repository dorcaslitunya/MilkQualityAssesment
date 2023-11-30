<?php
defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']. "/");

// --------- display all errors --------- 
include_once site . "/dashboard/error_toggle.php";
// ----------- error display ------------

// Function to log errors
function logError($message)
{
    $scriptDir = __DIR__;

    // Specify the path to your log file relative to the script directory
    $logFile = $scriptDir . "/error_log/error.log";

    // Log the error message along with a timestamp
    error_log(date('[Y-m-d H:i:s]') . ' ' . $message . "\n", 3, $logFile);
}

if (empty($_POST["name"])) {
    logError("Name is required");
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    logError("Valid email is required");
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    logError("Password must be at least 8 characters");
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    logError("Password must have at least one letter");
    die("Password must have at least one letter");
}

if (!preg_match("/[0-9]/i", $_POST["password"])) {
    logError("Password must have at least one number");
    die("Password must have at least one number");
}

if ($_POST["password"] !== $_POST["confirm_password"]) {
    logError("Passwords do not match");
    die("Passwords do not match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES(?,?,?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    logError("SQL error: " . $mysqli->error);
    die("SQL error: " . $mysqli->error);
}

// Add bind to the statement object
$stmt->bind_param(
    "sss",
    $_POST["name"],
    $_POST["email"],
    $password_hash
);

if ($stmt->execute()) {
    header("Location: signup-success.html");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        logError("Email already taken");
        die("Email already taken");
    } else {
        logError($mysqli->error . " " . $mysqli->errno);
        die($mysqli->error . " " . $mysqli->errno);
    }
}
