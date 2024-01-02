<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the ID of the record to update and the new emotion
$videoID_to_update = 'your_video_id_here';
$new_emotion = 'your_new_emotion_here';

// Define the SQL statement
$sql = "UPDATE `video_diary` SET `emotion` = '$new_emotion' WHERE `videoID` = '$videoID_to_update'";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the connection
$conn->close();
?>