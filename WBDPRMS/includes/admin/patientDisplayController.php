<?php
include_once('../../includes/conn.php');

// Fetch all pending patients
$query = "SELECT patient_id, patient_fName, patient_midInitial, patient_lName, patient_suffix, patient_sex, patient_age, patient_address, patient_complaint, patient_remarks, patient_referral, created_at
          FROM tbl_patients
          WHERE patient_status = 'pending'";
$resultPending = $mysqli->query($query);
if (!$resultPending) {
    die("Query Failed: " . $mysqli->error);
}

// Handle approve action
if (isset($_GET['action']) && $_GET['action'] === 'approve' && isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $approveQuery = "UPDATE tbl_patients SET patient_status = 'approved' WHERE patient_id = ?";
    $stmt = $mysqli->prepare($approveQuery);
    $stmt->bind_param("i", $patient_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Patient approved successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to approve patient.";
    }

    $stmt->close();
    header("Location: ../../admin/patient/pending.php");
    exit();
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $deleteQuery = "UPDATE tbl_patients SET patient_status = 'declined' WHERE patient_id = ?";
    $stmt = $mysqli->prepare($deleteQuery);
    $stmt->bind_param("i", $patient_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Patient deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete patient.";
    }

    $stmt->close();
    header("Location: ../../admin/patient/pending.php");
    exit();
}
?>
