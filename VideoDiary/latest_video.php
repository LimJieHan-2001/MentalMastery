<?php
$dir = 'uploads/';
$files = array_diff(scandir($dir, SCANDIR_SORT_DESCENDING), array('..', '.'));
$latest_file = $files[0];
echo $latest_file;
?>