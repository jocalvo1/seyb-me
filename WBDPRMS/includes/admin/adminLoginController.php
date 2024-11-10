<?php
session_start();
include __DIR__ . '/../conn.php';

if (isset($_POST["login"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['admin_username'];
  $password = $_POST['admin_password'];

  if (!empty($username) && !empty($password)) {
    // Prepare the statement
    if ($stmt = $mysqli->prepare("SELECT * FROM tbl_admin WHERE admin_username = ? AND admin_password = ? ")) {
      // Bind parameters
      $stmt->bind_param("ss", $username, $password);

      // Execute the statement
      $stmt->execute();

      // Get the result
      $result = $stmt->get_result();

      // Check if the query returned any rows
      if ($result->num_rows == 0) {
        // Invalid username or password
        $_SESSION['error'] = "Invalid username / password.";
        header("Location: ../../admin/index.php");
        exit();
      } else {
        // Successful login
        $_SESSION['admin_username'] = $username;
        header("location: ../../admin/main/index.php");
        exit();
      }

      // Close the statement
      $stmt->close();
    } else {
      // Error with the SQL statement preparation
      echo "Error: Could not prepare the SQL statement.";
      exit();
    }
  } else {
    // Username or password is empty
    $_SESSION['error'] = "Username / Password is empty.";
    echo "<script>window.location.href='../../admin/index.php';</script>";
    exit();
  }
}
