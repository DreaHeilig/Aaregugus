<?php

include 'transform.php';
require_once 'config.php';

// Database connection using PDO
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Insert data into the aaregugus table
$sql = "INSERT INTO aaregugus (speed, travelTime, temperature) VALUES (:speed, :travelTime, :temperature)";

$stmt = $pdo->prepare($sql);

// Bind the values from the $aareDataTrans array to the SQL statement
$stmt->bindParam(':speed', $aareDataTrans['speed']);
$stmt->bindParam(':travelTime', $aareDataTrans['travelTime']);
$stmt->bindParam(':temperature', $aareDataTrans['temperature']);

// Execute the statement
if ($stmt->execute()) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data.";
}
?>
