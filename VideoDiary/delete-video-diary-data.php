<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the ID of the record to delete
$videoID_to_delete = 'your_video_id_here';

// Define the SQL statement
$sql = "DELETE FROM `video_diary` WHERE `videoID` = '$videoID_to_delete'";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the connection
$conn->close();
?>