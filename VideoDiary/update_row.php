<?php
// Get the data from the request
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$emotion = $_POST['emotion'];

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
$stmt = $conn->prepare("UPDATE `video_diary` SET `videoTitle` = ?, `description` = ?, `emotion` = ? WHERE `videoID` = ?");
$stmt->bind_param("sssi", $title, $description, $emotion, $id);

// Execute the statement
$success = $stmt->execute();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Return the result as a JSON object
echo json_encode(['success' => $success]);
?>