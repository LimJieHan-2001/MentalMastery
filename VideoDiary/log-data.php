<?php
// Include the database connection file
include 'connect-database.php';

// Prepare an SQL statement
$sql = "INSERT INTO video_details (video_name, video_url, most_common_emotion) VALUES (?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters to the prepared statement
$stmt->bind_param("sss", $video_name, $video_url, $most_common_emotion);

// Set values to the parameters
$video_name = "video_name";  // replace with your video name
$video_url = "video_url";  // replace with your video URL
$most_common_emotion = "most_common_emotion";  // replace with your most common emotion

// Execute the prepared statement
$stmt->execute();

echo "New record created successfully";

// Close the prepared statement
$stmt->close();
?>