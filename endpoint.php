<?php

echo "Hello World";

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

    // Convert the arrays to JSON
    $recentDataJson = json_encode($recentData, JSON_PRETTY_PRINT);
    $averagesJson = json_encode($averages, JSON_PRETTY_PRINT);

    // Display the JSON results
    echo '<pre>';
    echo "Most Recent Entry (JSON):\n";
    echo $recentDataJson;
    echo "\n\nAverage Travel Times for the Last 3 Days (JSON):\n";
    echo $averagesJson;
    echo '</pre>';

} catch (PDOException $e) {
    // Handle any errors
    echo 'Error: ' . $e->getMessage();
}

?>