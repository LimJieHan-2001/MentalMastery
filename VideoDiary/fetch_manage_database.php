<?php
$servername = "localhost";  
$username = "rk"; 
$password = "password123";
$dbname = "mental_masterydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Define the SQL statement
$sql = "SELECT `videoID`, `videoTitle`, `description`, `emotion` FROM `video_diary` ORDER BY `videoID` DESC";

// Execute the SQL statement
$result = $conn->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die(json_encode(array('error' => 'Query failed: ' . $conn->error)));
}

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Fetch all rows
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(array('error' => 'No rows returned from the database'));
}
?>