<?php
// Directory path
$dir = 'C:\\XAMPP\\htdocs\\uploads\\';

// Get filenames
$files = array_diff(scandir($dir), array('.', '..'));

// Sort files by modification time
usort($files, function($a, $b) use ($dir) {
    return filemtime($dir . $b) - filemtime($dir . $a);
});

// Get the most recently modified file
$latest_file = $files[0];

// Return the filename
echo $latest_file;
?>