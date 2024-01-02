<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// error reporting measures
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get the video ID from the request
$videoId = $_POST['videoId'];

// Define the SQL statement
$sql = "SELECT `videoTitle`, `videoDescription`, `emotion` FROM `video_diary` WHERE `videoID` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the video ID to the SQL statement
$stmt->bind_param('i', $videoId);

// Execute the SQL statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Fetch the row
    $row = $result->fetch_assoc();

    // Return the row as a JSON object
    echo json_encode($row);
}

// Close the connection
$conn->close();
?>