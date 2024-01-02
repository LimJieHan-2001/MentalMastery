<?php
// Directory path
$dir =  __DIR__ . '/uploads/';

// URL path
$url_path = 'http://localhost/AppDev/VideoDiary/uploads/';

// Get filenames
$files = array_diff(scandir($dir), array('.', '..'));

// Sort files by modification time
usort($files, function($a, $b) use ($dir) {
    return filemtime($dir . $b) - filemtime($dir . $a);
});

// Get the most recently modified file
$latest_file = $files[0];

// Create the URL of the latest video
$video_url = $url_path . $latest_file;

// Write the URL to a text file
file_put_contents('latest_video_url.txt', $video_url);

// Get the URL of the latest video
$video_url = file_get_contents('latest_video_url.txt');

// // Return the URL
// echo $latest_video_url;
?>