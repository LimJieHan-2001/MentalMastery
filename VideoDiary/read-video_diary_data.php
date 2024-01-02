<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the SQL statement
$sql = "SELECT `videoID`, `videoURL`, `emotion` FROM `video_details`";

// Execute the SQL statement
$result = $conn->query($sql);

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Output the data of each row
    while($row = $result->fetch_assoc()) {
        echo "videoID: " . $row["videoID"]. " - videoURL: " . $row["videoURL"]. " - emotion: " . $row["emotion"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>