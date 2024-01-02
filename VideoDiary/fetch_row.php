<?php
// Get the ID from the request
$id = $_GET['id'];

// Database credentials
$servername = "localhost";
$username = "rk";
$password = "password123";
$dbname = "mental_masterydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("SELECT `videoID`, `videoTitle`, `description`, `emotion` FROM `video_diary` WHERE `videoID` = ?");
$stmt->bind_param("i", $id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the data
$data = $result->fetch_assoc();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Return the data as a JSON object
echo json_encode($data);
?>