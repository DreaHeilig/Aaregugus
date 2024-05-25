<?php

require_once 'config.php';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);

    // Prepare a SQL query to select all rows from the aaregugus table ordered by created descending
    $sql = 'SELECT * FROM aaregugus ORDER BY created DESC';

    // Execute the query
    $stmt = $pdo->query($sql);

    // Fetch all the rows from the query result
    $rows = $stmt->fetchAll();

    // Save the speed, travelTime, and temperature of the most recent entry
    $mostRecentEntry = $rows[0];
    $recentData = [
        'speed' => $mostRecentEntry['speed'],
        'travelTime' => $mostRecentEntry['travelTime'],
        'temperature' => $mostRecentEntry['temperature']
    ];

    // Calculate the averages for the last 3 days
    $averages = [];
    $today = new DateTime();
    for ($i = 1; $i <= 3; $i++) {
        $date = $today->sub(new DateInterval('P1D'))->format('Y-m-d');
        $stmt = $pdo->prepare('SELECT AVG(travelTime) as averageTravelTime FROM aaregugus WHERE DATE(created) = :date');
        $stmt->execute(['date' => $date]);
        $result = $stmt->fetch();
        $averages[$date] = round($result['averageTravelTime']);
    }

    // Prepare the response data
    $responseData = [
        'recentData' => $recentData,
        'averages' => $averages
    ];

    // Set the content type to JSON
    header('Content-Type: application/json');

    // Return the JSON encoded data
    echo json_encode($responseData, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}

?>