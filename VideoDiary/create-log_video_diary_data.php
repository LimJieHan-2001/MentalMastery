<?php
// Include the file that contains the videoID, video_url, most_common_emotion variable
include 'get_latest_video_id.php';
include 'get_video_url.php';
include 'get_emotion.php';

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
echo "Connected successfully";

// Prepare an SQL statement to check if videoID already exists
$checkSql = "SELECT * FROM `video_diary` WHERE `videoID` = ?";

// Create a prepared statement
$checkStmt = $conn->prepare($checkSql);

// Bind parameters to the prepared statement
$checkStmt->bind_param("s", $video_id);

// Execute the prepared statement
$checkStmt->execute();

// Get the result of the query
$result = $checkStmt->get_result();

// If the videoID already exists in the database, don't insert a new record
if ($result->num_rows > 0) {
  echo "Record already exists";
} else {
  // Prepare an SQL statement
  $sql = "INSERT INTO `video_diary`(`videoID`, `videoURL`, `emotion`) VALUES (?, ?, ?)";

  // Create a prepared statement
  $stmt = $conn->prepare($sql);

  // Bind parameters to the prepared statement
  $stmt->bind_param("sss", $video_id, $video_url, $most_common_emotion);

  // Execute the prepared statement
  $stmt->execute();

  echo "New record created successfully";

  // Close the prepared statement
  $stmt->close();
}

// Close the checkStmt prepared statement
$checkStmt->close();

// Close the connection
$conn->close();
?>