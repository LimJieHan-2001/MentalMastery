<?php
// Get the id parameter from the POST data
$id = $_POST['id'];

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

// Prepare a DELETE query
$stmt = $conn->prepare("DELETE FROM `video_diary` WHERE `videoID` = ?");
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
  // The query was successful, return a success message
  echo json_encode(['success' => 'Row deleted successfully.']);
} else {
  // The query failed, return an error message
  echo json_encode(['error' => 'Failed to delete row.']);
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>