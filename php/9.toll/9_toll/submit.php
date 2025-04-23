<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_number = $_POST['vehicle_number'];
    $vehicle_type = $_POST['vehicle_type'];

    // Toll rate logic
    $rates = [
        'Bike' => 20,
        'Car' => 50,
        'Truck' => 100
    ];

    $toll_amount = $rates[$vehicle_type];

    $sql = "INSERT INTO toll_records (vehicle_number, vehicle_type, toll_amount)
            VALUES ('$vehicle_number', '$vehicle_type', '$toll_amount')";

    if ($conn->query($sql)) {
        echo "Toll recorded successfully. <a href='index.php'>Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
