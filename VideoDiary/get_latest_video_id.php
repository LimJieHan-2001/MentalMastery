<?php
// Directory path
$dir = __DIR__ . '/uploads/';

// Get filenames
$files = array_diff(scandir($dir), array('.', '..'));

// Sort files by modification time
usort($files, function($a, $b) use ($dir) {
    return filemtime($dir . $b) - filemtime($dir . $a);
});

// Get the most recently modified file
$video_id = $files[0];

// Write the URL to a text file
file_put_contents('latest_video_id.txt', $video_id);

// Get the URL of the latest video
$video_id = file_get_contents('latest_video_id.txt');

// Return the filename
// echo $video_id;
?>