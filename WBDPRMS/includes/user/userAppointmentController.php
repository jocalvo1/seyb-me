<?php
session_start();
include_once '../conn.php'; // Include database connection file

// Check if form is submitted
if (isset($_POST['book_appointment'])) {
  // Retrieve user input from the form
  $user_username = $_SESSION['user_username']; // Assuming the user is logged in
  $appointment_reason = trim($_POST['user_appointmentReason']);
  $appointment_date = $_POST['appointment_date'];

  // Validate appointment date (must be in the future)
  $current_date = date('Y-m-d');
  if ($appointment_date <= $current_date) {
    $_SESSION['error'] = "Appointment date must be in the future.";
    header("Location: ../../user/appointment/index.php");
    exit();
  }

  // Get the user ID based on the username
  $sql = "SELECT user_id FROM tbl_user WHERE user_username = ?";
  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('s', $user_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user_id = $row['user_id'];

      // Insert the appointment into the database
      $sql = "INSERT INTO tbl_appointment (user_id, appointment_reason, appointment_date) VALUES (?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('iss', $user_id, $appointment_reason, $appointment_date);

        // Execute the query
        if ($stmt->execute()) {
          $_SESSION['success'] = "Appointment booked successfully!";
          header("Location: ../../user/appointment/index.php");
          exit(); // Make sure to exit after redirection to avoid further code execution
        } else {
          $_SESSION['error'] = "Error: " . $stmt->error;
          header("Location: ../../user/appointment/index.php");
          exit();
        }
      } else {
        $_SESSION['error'] = "Database error: " . $mysqli->error;
        header("Location: ../../user/appointment/index.php");
        exit();
      }
    } else {
      $_SESSION['error'] = "User not found!";
      header("Location: ../../user/appointment/index.php");
      exit();
    }

    $stmt->close();
  } else {
    $_SESSION['error'] = "Database error: " . $mysqli->error;
    header("Location: ../../user/appointment/index.php");
    exit();
  }

  $mysqli->close();
} else {
  // Redirect if the form is not submitted
  $_SESSION['error'] = "Invalid request.";
  header("Location: ../../user/appointment/index.php");
  exit();
}
