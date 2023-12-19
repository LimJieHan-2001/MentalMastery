<?php
$servername = "localhost";  // replace with your server name
$username = "loke";  // replace with your username
$password = "password123";  // replace with your password
$dbname = "videodiarydb";  // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>