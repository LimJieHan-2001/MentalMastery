<?php
// Include the file that contains the videoID, video_url, most_common_emotion variable
include 'get_latest_video_id.php';
include 'get_video_url.php';
include 'get_emotion.php';

// For debugging - Print the values of the variables
// echo "video_id: $video_id<br>";
// echo "video_url: $video_url<br>";
// echo "most_common_emotion: $most_common_emotion<br>";

$servername = "localhost";  // replace with your server name
$username = "loke";  // replace with your username
$password = "password123";  // replace with your password
$dbname = "videodiarydb";  // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Prepare an SQL statement
$sql = "INSERT INTO `video details`(`videoID`, `videoURL`, `Emotion`) VALUES (?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);


// Bind parameters to the prepared statement
$stmt->bind_param("sss", $video_id, $video_url, $most_common_emotion);

// Execute the prepared statement
$stmt->execute();

$conn->commit();

echo "New record created successfully";

// Close the prepared statement
$stmt->close();

?>