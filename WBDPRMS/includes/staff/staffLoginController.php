<?php
session_start();
include_once '../conn.php';

if (isset($_POST['login'])) {
  $username = trim($_POST['staff_username']);
  $password = trim($_POST['staff_password']);

  // Check if the username exists in the database
  $sql = "SELECT * FROM tbl_staff WHERE staff_username = ?";
  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // Verify the password
      if (password_verify($password, $row['staff_password'])) {

        if ($row['staff_status'] === 'pending') {
          $_SESSION['pending'] = "Your account has not been approved yet. Please wait patiently!";
          header("Location: ../../staff/index.php");
          exit();
        } else {
          $_SESSION['staff_username'] = $username; // Store username in session
          $_SESSION['staff_lastname'] = $row['staff_lastName']; // Store last name in session
          $_SESSION['sex'] = $row['staff_sex']; // Store gender in session

          header("Location: ../../staff/main/index.php");
          exit();
        }
      } else {
        $_SESSION['error'] = "Invalid username / password.";
        header("Location: ../../staff/index.php");
        exit();
      }
    } else {
      $_SESSION['error'] = "Invalid username / password.";
      header("Location: ../../staff/index.php");
      exit();
    }
  } else {
    $_SESSION['error'] = "Database error: " . $mysqli->error;
    header("Location: ../../staff/index.php");
    exit();
  }

  $stmt->close();
  $mysqli->close();
}
