<?php
  // Set the default timezone
  date_default_timezone_set('Asia/Singapore');
  
  // Check if file was uploaded
  if(isset($_FILES['video'])) {
    $errors = array();

    $file_name = $_FILES['video']['name'];
    $file_size = $_FILES['video']['size'];
    $file_tmp = $_FILES['video']['tmp_name'];
    $file_type = $_FILES['video']['type'];
    $explodedName = explode('.', $_FILES['video']['name']);
    $file_ext = strtolower(end($explodedName));

    $extensions = array("webm");
    

    if(in_array($file_ext, $extensions) === false){
      $errors[] = "extension not allowed, please choose a webm file.";
    }

    if(empty($errors) == true) {
      // Format the current date and time as a string
      $datetime = date('His_dmy');

      // Append datetime to filename
      $file_name = $datetime . '.' . $file_ext;

      // Check if uploads directory exists and is writable
      if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
      }

      if (is_writable('uploads')) {
        if (move_uploaded_file($file_tmp, "uploads/".$file_name)) {
          echo "Success";
        } else {
          echo "Error: Failed to move uploaded file.";
        }
      } else {
        echo "Error: uploads directory is not writable.";
      }
    } else {
      print_r($errors);
    }
  } else {
    echo "Error: No file uploaded.";
  }
?>