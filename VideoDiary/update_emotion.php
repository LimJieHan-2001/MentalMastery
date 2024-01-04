<?php
// Database configuration
$servername = "localhost";  
$username = "rk"; 
$password = "password123";
$dbname = "mental_masterydb";

// Create database connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the filename and emotion from the POST data
$videoID = $_POST['videoID'];
$emotion = $_POST['emotion'];
// Prepare a SQL statement to update the record
$stmt = $db->prepare("UPDATE video_diary SET emotion = ? WHERE videoID = ?");

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Failed to prepare SQL statement: " . $db->error);
}

// Bind the emotion and filename to the SQL statement
$stmt->bind_param("ss", $emotion, $videoID);

// Execute the SQL statement
if (!$stmt->execute()) {
    die("Failed to execute SQL statement: " . $stmt->error);
}

// Close the statement and the database connection
$stmt->close();
$db->close();
?>