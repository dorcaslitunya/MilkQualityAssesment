<?php
defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']. "/");
// --------- display all errors --------- 
include_once site . "/dashboard/error_toggle.php";
// ----------- error display ------------

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    $email = $mysqli->real_escape_string($_POST["email"]);
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $email);

    $result = $mysqli->query($sql);

    if ($result === false) {
        // Log SQL error
        $sqlError = "SQL error: " . $mysqli->error;
        error_log($sqlError, 3, __DIR__ . "/error_log/error.log");
        die($sqlError);
    }

    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: /dashboard/Overview/overview.php");
            exit;
        }
    }

    $is_invalid = true;

    // Log failed login attempt
    $loginError = "Failed login attempt for email: $email";
    error_log($loginError, 3, __DIR__ . "/error_log/error.log");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>

<body>
    <h1>Login</h1>

    <?php if ($is_invalid):?>
        <em>Invalid login</em>
    <?php endif; ?>

    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "" )?>">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <button>Login</button>
    </form>
</body>
</html>
