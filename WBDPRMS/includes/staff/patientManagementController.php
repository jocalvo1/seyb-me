<?php
if (session_id() == '') {
  session_start();
  if (!isset($_SESSION['staff_username'])) {
    header("Location: ../index.php");
    exit();
  }
}
require('../../includes/conn.php'); // Database connection file

if (isset($_POST['add_record'])) {
    // Collect form data
    $firstName = ucfirst(trim($_POST['patient_fName']));
    $middleInitial = ucfirst(trim($_POST['patient_midInitial']));
    $lastName = ucfirst(trim($_POST['patient_lastName']));
    $suffix = !empty($_POST['patient_suffix']) ? trim($_POST['patient_suffix']) : null;
    $age = intval($_POST['patient_age']);
    $sex = $_POST['patient_sex'];
    $address = ucwords(trim($_POST['patient_address'])); // Capitalize each word for addresses
    $complaint = ucfirst(trim($_POST['patient_complaint']));
    $referral = ucfirst(trim($_POST['patient_referral']));
    $remarks = ucfirst(trim($_POST['patient_remarks']));
    $status = 'pending'; // Default status

    // Insert query with default status
    $query = "INSERT INTO tbl_patients (patient_fName, patient_midInitial, patient_lName, patient_suffix, patient_age, patient_sex, patient_address, patient_complaint, patient_referral, patient_remarks, patient_status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("sssisssssss", $firstName, $middleInitial, $lastName, $suffix, $age, $sex, $address, $complaint, $referral, $remarks, $status);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Patient record added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add patient record. Please try again.";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Database error: Unable to prepare statement.";
    }

    // Redirect back to the form page with success or error message
    header("Location: ../../staff/patient/addPatient.php");
    exit();
}
