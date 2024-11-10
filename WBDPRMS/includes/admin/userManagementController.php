<?php
include __DIR__ . '/../conn.php';

// Approve or delete user based on the action
if (isset($_GET['action']) && isset($_GET['user_id'])) {
  $userId = $_GET['user_id'];
  if ($_GET['action'] == 'approve') {
    $sql = "UPDATE tbl_user SET user_status = 'approved' WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
  } elseif ($_GET['action'] == 'delete') {
    $sql = "DELETE FROM tbl_user WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
  }
}

// Fetch pending users
$sqlPending = "SELECT * FROM tbl_user WHERE user_status = 'pending'";
$resultPending = $mysqli->query($sqlPending);

// Fetch approved users
$sqlApproved = "SELECT * FROM tbl_user WHERE user_status = 'approved'";
$resultApproved = $mysqli->query($sqlApproved);


// Edit process
if (isset($_POST['update'])) {
  $userId = $_POST['user_id'];
  $firstName = $_POST['user_firstName'];
  $midInitial = $_POST['user_midInitial'];
  $lastName = $_POST['user_lastName'];
  $suffix = $_POST['user_suffix'];
  $birthDate = $_POST['user_birthDate'];
  $contactNumber = $_POST['user_contactNumber'];
  $sex = $_POST['user_sex'];
  $address = $_POST['user_address'];

  $sql = "UPDATE tbl_user 
          SET user_firstName = ?, user_midInitial = ?, user_lastName = ?, user_suffix = ?, user_birthDate = ?, user_contactNumber = ?, user_sex = ?, user_address = ?
          WHERE user_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ssssssssi", $firstName, $midInitial, $lastName, $suffix, $birthDate, $contactNumber, $sex, $address, $userId);
  $stmt->execute();
  $stmt->close();

  header("Location: ../../admin/accounts/index.php");
  exit();
}
