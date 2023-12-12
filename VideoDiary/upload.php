<?php
// Include the database connection file
include 'connect-database.php';

// Include the file that contains the most_common_emotion variable
include 'run_fer.php';

// Check if file was uploaded
if(isset($_FILES['video'])) {
  $errors = array();

  $file_name = $_FILES['video']['name'];
  $file_size = $_FILES['video']['size'];
  $file_tmp = $_FILES['video']['tmp_name'];
  $file_type = $_FILES['video']['type'];
  $file_ext = strtolower(end(explode('.', $_FILES['video']['name'])));

  $extensions = array("webm");

  if(in_array($file_ext, $extensions) === false){
    $errors[] = "extension not allowed, please choose a webm file.";
  }

  if(empty($errors) == true) {
    // Append timestamp to filename
    $file_name = time() . '_' . $file_name;
    move_uploaded_file($file_tmp, "uploads/".$file_name);

    // Call the Python script with the video name and URL as command line arguments
    $video_url = "uploads/".$file_name; // Assuming the URL is the path in the uploads directory
    shell_exec("C:\Users\ACER\OneDrive\Documents\GitHub\MentalMastery\VideoDiary\emotionRecog\fer.py $file_name $video_url");

    // Prepare an SQL statement
    $sql = "INSERT INTO video_details (Title, videoURL, Emotion) VALUES (?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("sss", $file_name, $video_url, $most_common_emotion);

    // Execute the prepared statement
    $stmt->execute();

    echo "New record created successfully";

    // Close the prepared statement
    $stmt->close();

    echo "Success";
  } else {
    print_r($errors);
  }
}
?>