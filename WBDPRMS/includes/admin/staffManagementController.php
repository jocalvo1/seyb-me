<?php
include __DIR__ . '/../conn.php';

// Approve or delete staff based on the action
if (isset($_GET['action']) && isset($_GET['staff_id'])) {
  $staffId = $_GET['staff_id'];
  if ($_GET['action'] == 'approve') {
    $sql = "UPDATE tbl_staff SET staff_status = 'approved' WHERE staff_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $staffId);
    $stmt->execute();
    $stmt->close();
  } elseif ($_GET['action'] == 'delete') {
    $sql = "DELETE FROM tbl_staff WHERE staff_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $staffId);
    $stmt->execute();
    $stmt->close();
  }
}

// Fetch pending staffs
$sqlPending = "SELECT * FROM tbl_staff WHERE staff_status = 'pending'";
$resultPending = $mysqli->query($sqlPending);

// Fetch approved staffs
$sqlApproved = "SELECT * FROM tbl_staff WHERE staff_status = 'approved'";
$resultApproved = $mysqli->query($sqlApproved);

// Edit process
if (isset($_POST['update'])) {
  $staffId = $_POST['staff_id'];
  $firstName = $_POST['staff_firstName'];
  $midInitial = $_POST['staff_midInitial'];
  $lastName = $_POST['staff_lastName'];
  $suffix = $_POST['staff_suffix'];
  $birthDate = $_POST['staff_birthDate'];
  $contactNumber = $_POST['staff_contactNumber'];
  $sex = $_POST['staff_sex'];
  $address = $_POST['staff_address'];

  $sql = "UPDATE tbl_staff 
          SET staff_firstName = ?, staff_midInitial = ?, staff_lastName = ?, staff_suffix = ?, staff_birthDate = ?, staff_contactNumber = ?, staff_sex = ?, staff_address = ?
          WHERE staff_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ssssssssi", $firstName, $midInitial, $lastName, $suffix, $birthDate, $contactNumber, $sex, $address, $staffId);
  $stmt->execute();
  $stmt->close();

  header("Location: ../../admin/accounts/staff.php");
  exit();
}
