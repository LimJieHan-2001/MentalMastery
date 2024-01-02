<?php
$servername = "localhost";  // replace with your server name
$username = "rk";  // replace with your username
$password = "password123";  // replace with your password
$dbname = "mental_masterydb";  // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Prepare an SQL statement
$sql = "INSERT INTO `video_diary`(`videoID`, `videoURL`, `emotion`) VALUES (?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters to the prepared statement
$stmt->bind_param("sss", $video_id, $video_url, $most_common_emotion);

// Set values to the parameters
$video_id = "test1";  // replace with your video name
$video_url = "video_urltest1";  // replace with your video URL
$most_common_emotion = "most_common_emotiontest1";  // replace with your most common emotion

// Execute the prepared statement
$stmt->execute();

echo "New record created successfully";

// Close the prepared statement
$stmt->close();
?>