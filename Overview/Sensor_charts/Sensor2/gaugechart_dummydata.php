<?php
// Function to generate random timestamp
function getRandomTimestamp($start, $end)
{
    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    return date("Y-m-d H:i:s", $randomTimestamp);
}

// Function to generate random sensor data
function getRandomSensorData()
{
    return [
        "sens_1" => rand(1000, 1200) + (rand(0, 99) / 100), // Random value with two decimal places
        "sens_2" => rand(400, 500) + (rand(0, 99) / 100),
        "sens_5" => rand(300, 400) + (rand(0, 99) / 100),
    ];
}

// Number of data points to generate
$numDataPoints = 10;

// Start and end timestamps for data generation
$endTimestamp = time(); // Current timestamp
$startTimestamp = strtotime("-1 day"); // 1 day ago

// Generate JSON structure
$data = [
    "succ" => 1,
    "load" => []
];

for ($i = 0; $i < $numDataPoints; $i++) {
    $timestamp = getRandomTimestamp(date("Y-m-d H:i:s", $startTimestamp), date("Y-m-d H:i:s", $endTimestamp));
    $unixTimestamp = strtotime($timestamp);
    $sensorData = getRandomSensorData();

    $data["load"][] = [
        "timestamp" => $timestamp,
        "unix_timestamp" => (string)$unixTimestamp,
        "sensor_data" => $sensorData
    ];
}

// Convert data to JSON and output
$jsonOutput = json_encode($data, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $jsonOutput;
