<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the SQL statement
$sql = "SELECT `emotion` FROM `video_diary` ORDER BY `videoID` DESC LIMIT 1";

// Execute the SQL statement
$result = $conn->query($sql);

// Initialize the response as an empty array
$response = [];

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Fetch the first row
    $row = $result->fetch_assoc();

    // Check if the emotion is either 'sad' or 'angry'
    if ($row['emotion'] == 'sad' || $row['emotion'] == 'angry'|| $row['emotion'] == 'neutral') {
        // Define the path to the 'happy base' folder
        $dir = 'happyBase';

        // Get the filenames in the 'happy base' folder
        $files = array_diff(scandir($dir), array('.', '..'));

        // Select a random file
        $random_file = $files[array_rand($files)];

        // Set the emotion and the image URL in the response
        $response = ['emotion' => $row['emotion'], 'imageUrl' => "$dir/$random_file"];
    }
}

// Output the response in JSON format
echo json_encode($response);

// Close the connection
$conn->close();
?>