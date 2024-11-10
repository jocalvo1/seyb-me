<?php
session_start();
include_once '../conn.php';

if (isset($_POST['register'])) {
  // Retrieve and sanitize input fields
  $user_username = trim($_POST['user_username']);
  $user_password = password_hash(trim($_POST['user_password']), PASSWORD_DEFAULT);
  $user_firstName = trim(ucwords($_POST['user_firstName']));
  $user_midInitial = strtoupper(trim($_POST['user_midInitial']));
  $user_lastName = trim(ucwords($_POST['user_lastName']));
  $user_suffix = !empty($_POST['user_suffix']) ? trim($_POST['user_suffix']) : null;
  $user_birthDate = trim($_POST['user_birthDate']);
  $user_contactNumber = trim($_POST['user_contactNumber']);
  $user_sex = trim($_POST['user_sex']);
  $user_address = trim($_POST['user_address']);

  // Handle file upload for user_photo
  $target_dir = "../../pictures/user/"; // Set the target directory
  $file_name = basename($_FILES["user_photo"]["name"]);
  $target_file = $target_dir . $user_username . "_" . time() . "_" . $file_name;
  $uploadOk = 1;

  // Check if file was uploaded
  if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
    // Check file extension
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png");

    if (!in_array($imageFileType, $allowed_extensions)) {
      $_SESSION['error'] = 'Only JPG, JPEG, and PNG files are allowed.';
      $uploadOk = 0;
    }

    // Check file size (limit to 3MB)
    if ($_FILES["user_photo"]["size"] > 3000000) {
      $_SESSION['error'] = 'Your file is too large. Maximum allowed size is 3MB.';
      $uploadOk = 0;
    }

    // If no errors, attempt to upload file
    if ($uploadOk == 1) {
      if (!move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file)) {
        $_SESSION['error'] = 'Sorry, there was an error uploading your file.';
        header("Location: ../../user/register.php");
        exit();
      } else {
        $user_photo = $target_file; // Store the path of the uploaded file
      }
    } else {
      header("Location: ../../user/register.php");
      exit();
    }
  } else {
    $_SESSION['error'] = 'Please upload a photo.';
    header("Location: ../../user/register.php");
    exit();
  }

  // Prepare SQL statement for insertion
  $sql = "INSERT INTO tbl_user (
                user_username, 
                user_password, 
                user_firstName, 
                user_midInitial, 
                user_lastName, 
                user_suffix, 
                user_birthDate, 
                user_contactNumber, 
                user_sex, 
                user_address, 
                user_photo,
                user_status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param(
      "sssssssssss",
      $user_username,
      $user_password,
      $user_firstName,
      $user_midInitial,
      $user_lastName,
      $user_suffix,
      $user_birthDate,
      $user_contactNumber,
      $user_sex,
      $user_address,
      $user_photo
    );

    // Execute statement
    if ($stmt->execute()) {
      $_SESSION['success'] = 'Registration successful!';
      header("Location: ../../user/index.php");
      exit();
    } else {
      if ($stmt->errno == 1062) { // Handle duplicate entry error
        $_SESSION['error'] = 'Username already taken.';
      } else {
        $_SESSION['error'] = 'Error: ' . $stmt->error;
      }
      header("Location: ../../user/register.php");
      exit();
    }

    $stmt->close();
  } else {
    $_SESSION['error'] = 'Error: ' . $mysqli->error;
    header("Location: ../../user/register.php");
    exit();
  }

  $mysqli->close();
}
