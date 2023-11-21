<?php
session_start();
// unset($_SESSION["email"]);
// unset($_SESSION["password"]);
// session_unset();
session_destroy();

// // include "rel_path.php";
// $this_file = $_SERVER['PHP_SELF'];
// // echo "<br> this file -> " . $this_file;
// $root_path = $_SERVER['DOCUMENT_ROOT']."/dashboard";
// // echo "<br> root path -> " . $root_path;
// $dir_path = dirname($_SERVER['PHP_SELF']);
// // echo "<br> dir path -> " . $dir_path;

// $redirect = $root_path . $dir_path . "/index.php";
// echo $redirect;
// header("Location:$redirect");

header("Location:/dashboard/#");

exit;
