<?php
$conn = new mysqli('localhost', 'root', '', 'scm_cloud');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if site_analytics table exists
$result = $conn->query("SHOW TABLES LIKE 'site_analytics'");
if ($result->num_rows > 0) {
    echo "site_analytics table EXISTS<br>";
    
    // Check records
    $count = $conn->query("SELECT COUNT(*) as cnt FROM site_analytics");
    $row = $count->fetch_assoc();
    echo "Records in site_analytics: " . $row['cnt'] . "<br>";
    
    // Show sample data
    $data = $conn->query("SELECT * FROM site_analytics LIMIT 5");
    echo "<br>Sample data:<br>";
    while($row = $data->fetch_assoc()) {
        print_r($row);
        echo "<br>";
    }
} else {
    echo "site_analytics table DOES NOT EXIST<br>";
    echo "Need to create the table first!<br>";
}

$conn->close();
?>
