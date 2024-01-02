<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the SQL statement
$sql = "SELECT `emotion` FROM `video_diary` ORDER BY `videoID` DESC LIMIT 1";

// Execute the SQL statement
$result = $conn->query($sql);

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Fetch the first row
    $row = $result->fetch_assoc();

    // Check if the emotion is 'happy'
    if ($row['Emotion'] == 'happy') {
        // Define the path to the 'happy base' folder
        $dir = 'happyBase';

        // Get the filenames in the 'happy base' folder
        $files = array_diff(scandir($dir), array('.', '..'));

        // Select a random file
        $random_file = $files[array_rand($files)];

        // Output an img element with the source set to the path of the random file
        echo "<img src='$dir/$random_file' alt='Happy Image'>";
    }
} else {
    echo "No results";
}

// Close the connection
$conn->close();
?>