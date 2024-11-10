<?php
session_start();
include_once '../conn.php';

if (isset($_POST['register'])) {
  // Retrieve and sanitize input fields
  $staff_username = trim($_POST['staff_username']);
  $staff_password = password_hash(trim($_POST['staff_password']), PASSWORD_DEFAULT);
  $staff_firstName = trim(ucwords($_POST['staff_firstName']));
  $staff_midInitial = strtoupper(trim($_POST['staff_midInitial']));
  $staff_lastName = trim(ucwords($_POST['staff_lastName']));
  $staff_suffix = !empty($_POST['staff_suffix']) ? trim($_POST['staff_suffix']) : null;
  $staff_birthDate = trim($_POST['staff_birthDate']);
  $staff_contactNumber = trim($_POST['staff_contactNumber']);
  $staff_sex = trim($_POST['staff_sex']);
  $staff_address = trim($_POST['staff_address']);

  // Handle file upload for staff_photo
  $target_dir = "../../pictures/staff/"; // Set the target directory
  $file_name = basename($_FILES["staff_photo"]["name"]);
  $target_file = $target_dir . $staff_username . "_" . time() . "_" . $file_name;
  $uploadOk = 1;

  // Check if file was uploaded
  if (isset($_FILES['staff_photo']) && $_FILES['staff_photo']['error'] === UPLOAD_ERR_OK) {
    // Check file extension
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png");

    if (!in_array($imageFileType, $allowed_extensions)) {
      $_SESSION['error'] = 'Only JPG, JPEG, and PNG files are allowed.';
      $uploadOk = 0;
    }

    // Check file size (limit to 3MB)
    if ($_FILES["staff_photo"]["size"] > 3000000) {
      $_SESSION['error'] = 'Your file is too large. Maximum allowed size is 3MB.';
      $uploadOk = 0;
    }

    // If no errors, attempt to upload file
    if ($uploadOk == 1) {
      if (!move_uploaded_file($_FILES["staff_photo"]["tmp_name"], $target_file)) {
        $_SESSION['error'] = 'Sorry, there was an error uploading your file.';
        header("Location: ../../staff/register.php");
        exit();
      } else {
        $staff_photo = $target_file; // Store the path of the uploaded file
      }
    } else {
      header("Location: ../../staff/register.php");
      exit();
    }
  } else {
    $_SESSION['error'] = 'Please use another photo.';
    header("Location: ../../staff/register.php");
    exit();
  }

  // Prepare SQL statement for insertion
  $sql = "INSERT INTO tbl_staff (
                staff_username, 
                staff_password, 
                staff_firstName, 
                staff_midInitial, 
                staff_lastName, 
                staff_suffix, 
                staff_birthDate, 
                staff_contactNumber, 
                staff_sex, 
                staff_address, 
                staff_photo,
                staff_status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param(
      "sssssssssss",
      $staff_username,
      $staff_password,
      $staff_firstName,
      $staff_midInitial,
      $staff_lastName,
      $staff_suffix,
      $staff_birthDate,
      $staff_contactNumber,
      $staff_sex,
      $staff_address,
      $staff_photo
    );

    // Execute statement
    if ($stmt->execute()) {
      $_SESSION['success'] = 'Registration successful!';
      header("Location: ../../staff/index.php");
      exit();
    } else {
      if ($stmt->errno == 1062) { // Handle duplicate entry error
        $_SESSION['error'] = 'Username already taken.';
      } else {
        $_SESSION['error'] = 'Error: ' . $stmt->error;
      }
      header("Location: ../../staff/register.php");
      exit();
    }

    $stmt->close();
  } else {
    $_SESSION['error'] = 'Error: ' . $mysqli->error;
    header("Location: ../../staff/register.php");
    exit();
  }

  $mysqli->close();
}
