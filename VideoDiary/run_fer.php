<?php
// Run the Python script
shell_exec('python emotionRecog/fer.py');

// Get the most common emotion from the output file
$most_common_emotion = file_get_contents('emotion_output.txt');

// Trim out extra white space
$most_common_emotion = trim($most_common_emotion);

// Send the most common emotion
echo $most_common_emotion;
?>