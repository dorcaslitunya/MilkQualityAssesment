<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

defined("site") or define("site", $_SERVER['DOCUMENT_ROOT'] . "/");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include site . "/dashboard/modules/html.header/header.php";
    include site . "/dashboard/modules/html.header/CDNs.jquery.php";
    include site . "/dashboard/modules/html.header/CDNs.bootstrap.php";
    include site . "/dashboard/modules/html.header/CDNs.chartJS.php";
    include site . "/dashboard/modules/html.header/CDNs.datatable.php";
    include site . "/dashboard/modules/html.header/CDNs.google.maps.php";
    include site . "/dashboard/modules/html.header/styles.css.php";
    ?>
</head>

<body>
    <div class="container-fluid">

        <?php
        include site . "/dashboard/Overview/Cards_overview/cards_overview.php";
        include site . "/dashboard/Overview/Sensor_charts/Sensor1/temp_sensor_canvas.php";
        include site . "/dashboard/Overview/Sensor_charts/Sensor2/pH_sensor_canvas.php";
        ?>

    </div>
</body>

</html>