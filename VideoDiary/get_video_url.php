<?php
// Directory path
$dir = 'C:\\XAMPP\\htdocs\\uploads\\';

// URL path
$url_path = 'http://localhost/uploads/';

// Get filenames
$files = array_diff(scandir($dir), array('.', '..'));

// Sort files by modification time
usort($files, function($a, $b) use ($dir) {
    return filemtime($dir . $b) - filemtime($dir . $a);
});

// Get the most recently modified file
$latest_file = $files[0];

// Create the URL of the latest video
$latest_video_url = $url_path . $latest_file;

// Return the URL
echo $latest_video_url;
?>