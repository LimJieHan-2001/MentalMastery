<?php
// Include the file that contains the connection to the database
include 'connect_database.php';

// Define the SQL statement
$sql = "SELECT `Emotion` FROM `video details` ORDER BY `videoID` DESC LIMIT 1";

// Execute the SQL statement
$result = $conn->query($sql);

// Initialize the response as an empty array
$response = [];

// Check if the SQL statement returned any rows
if ($result->num_rows > 0) {
    // Log the number of rows
    error_log("Number of rows: " . $result->num_rows);

    // Fetch the first row
    $row = $result->fetch_assoc();

    // Log the emotion
    error_log("Emotion: " . $row['Emotion']);

    // Check if the emotion is 'happy'
    if ($row['Emotion'] == 'sad') {
        // Define the path to the 'happy base' folder
        $dir = 'happyBase';

        // Get the filenames in the 'happy base' folder
        $files = array_diff(scandir($dir), array('.', '..'));

        // Select a random file
        $random_file = $files[array_rand($files)];

        // Set the emotion and the image URL in the response
        $response = ['emotion' => $row['Emotion'], 'imageUrl' => "$dir/$random_file"];
    }
}

// Output the response in JSON format
echo json_encode($response);

// Close the connection
$conn->close();
?>