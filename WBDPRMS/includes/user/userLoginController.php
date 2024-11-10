<?php
session_start();
include_once '../conn.php';

if (isset($_POST['login'])) {
  $username = trim($_POST['user_username']);
  $password = trim($_POST['user_password']);

  // Check if the username exists in the database
  $sql = "SELECT * FROM tbl_user WHERE user_username = ?";
  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // Verify the password
      if (password_verify($password, $row['user_password'])) {

        if ($row['user_status'] === 'pending') {
          $_SESSION['pending'] = "Your account has not been approved yet. Please wait patiently!";
          header("Location: ../../user/index.php");
          exit();
        } else {
          $_SESSION['user_username'] = $username; // Store username in session
          $_SESSION['user_lastname'] = $row['user_lastName']; // Store last name in session
          $_SESSION['sex'] = $row['user_sex']; // Store gender in session

          header("Location: ../../user/main/index.php");
          exit();
        }
      } else {
        $_SESSION['error'] = "Invalid username / password.";
        header("Location: ../../user/index.php");
        exit();
      }
    } else {
      $_SESSION['error'] = "Invalid username / password.";
      header("Location: ../../user/index.php");
      exit();
    }
  } else {
    $_SESSION['error'] = "Database error: " . $mysqli->error;
    header("Location: ../../user/index.php");
    exit();
  }

  $stmt->close();
  $mysqli->close();
}
