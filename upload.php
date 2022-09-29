<?php

if(!empty($_FILES)) {
  $target_dir = "uploads/";
$rename = time();
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$check = true;
$image = null;
// Check if file already exists
if (file_exists($target_file)) {
  $target_file = $target_dir.$rename.basename($_FILES["fileToUpload"]["name"]);
}
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["save"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $error = "<label class='text-danger'>File is not an image.</label>";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  $error = "<label class='text-danger'>Sorry, your file is too large.</label>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  $error = "<label class='text-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</label>";
  $uploadOk = 0;
}
if(file_exists($target_file)) {
    $error = "<label class='text-danger'>This file already exists.</label>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $error = "<label class='text-danger'>Sorry, your file was not uploaded.</label>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $image = $_FILES["fileToUpload"]["name"];
    $error = "<label class='text-danger'>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.</label>";
  } else {
    $error = "<label class='text-danger'>Sorry, there was an error uploading your file.</label>";
  }
}
}

?>