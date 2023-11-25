<?php
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
      move_uploaded_file($file_tmp, "uploads/".$file_name);
      echo "Success";
    } else {
      print_r($errors);
    }
  }
?>