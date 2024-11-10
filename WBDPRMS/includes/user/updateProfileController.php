<?php
session_start();
include_once '../../includes/conn.php';

if (isset($_POST['update_user'])) {
  // Retrieve and sanitize input fields
  $user_firstName = trim(ucwords($_POST['user_firstName']));
  $user_midInitial = strtoupper(trim($_POST['user_midInitial']));
  $user_lastName = trim(ucwords($_POST['user_lastName']));
  $user_suffix = !empty($_POST['user_suffix']) ? trim($_POST['user_suffix']) : null;
  $user_birthDate = trim($_POST['user_birthDate']);
  $user_contactNumber = trim($_POST['user_contactNumber']);
  $user_sex = trim($_POST['user_sex']);
  $user_photo = $_SESSION['user_photo']; // Default to current photo

  // Handle file upload for user_photo
  if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../../pictures/user/";
    $file_name = basename($_FILES["user_photo"]["name"]);
    $target_file = $target_dir . $_SESSION['user_username'] . "_" . time() . "_" . $file_name;
    $uploadOk = 1;

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
      if (move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file)) {
        $user_photo = $target_file; // Store the path of the new uploaded file
      } else {
        $_SESSION['error'] = 'Sorry, there was an error uploading your file.';
        header("Location: ../../user/history/index.php");
        exit();
      }
    }
  }

  // Update user information
  $sql = "UPDATE tbl_user SET 
                user_firstName = ?, 
                user_midInitial = ?, 
                user_lastName = ?, 
                user_suffix = ?, 
                user_birthDate = ?, 
                user_contactNumber = ?, 
                user_sex = ?, 
                user_photo = ? 
            WHERE user_username = ?";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param(
      "sssssssss",
      $user_firstName,
      $user_midInitial,
      $user_lastName,
      $user_suffix,
      $user_birthDate,
      $user_contactNumber,
      $user_sex,
      $user_photo,
      $_SESSION['user_username']
    );

    // Execute statement
    if ($stmt->execute()) {
      $_SESSION['success'] = 'Profile updated successfully!';
      // Update session variables
      $_SESSION['user_firstName'] = $user_firstName;
      $_SESSION['user_midInitial'] = $user_midInitial;
      $_SESSION['user_lastName'] = $user_lastName;
      $_SESSION['user_suffix'] = $user_suffix;
      $_SESSION['user_birthDate'] = $user_birthDate;
      $_SESSION['user_contactNumber'] = $user_contactNumber;
      $_SESSION['user_sex'] = $user_sex;
      $_SESSION['user_photo'] = $user_photo;

      header("Location: ../../user/history/index.php");
      exit();
    } else {
      $_SESSION['error'] = 'Error updating profile: ' . $stmt->error;
      header("Location: ../../user/history/index.php");
      exit();
    }

    $stmt->close();
  } else {
    $_SESSION['error'] = 'Error: ' . $mysqli->error;
    header("Location: ../../user/history/index.php");
    exit();
  }

  $mysqli->close();
}

