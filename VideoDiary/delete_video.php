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
$sql = "DELETE FROM `video_diary` WHERE `videoID` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the video ID to the SQL statement
$stmt->bind_param('i', $videoId);

// Execute the SQL statement
$stmt->execute();

// Check if the SQL statement was successful
if ($stmt->affected_rows > 0) {
    // Return a success message
    echo json_encode(['message' => 'Video deleted successfully.']);
} else {
    // Return an error message
    echo json_encode(['message' => 'Failed to delete video.']);
}

// Close the connection
$conn->close();
?>