<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include_once('../../includes/conn.php');

// Fetch all patients
$query = "SELECT patient_id, patient_fName, patient_midInitial, patient_lName, patient_suffix, patient_sex, patient_age, patient_address, patient_complaint, patient_remarks, patient_referral, created_at, patient_status
          FROM tbl_patients";
$resultAllPatients = $mysqli->query($query);
if (!$resultAllPatients) {
    die("Query Failed: " . $mysqli->error);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - All Patient Records</title>
    <?php include '../../templates/links.php'; ?>
</head>

<body>
    <div class="wrapper">
        <?php include '../templates/sidebar.php'; ?>
        <div class="main-panel">
            <?php include '../templates/topnav.php'; ?>
            <div class="content">
                <div class="row">
                    <div class="card table-with-links">
                        <div class="card-header">
                            <h4 class="card-title">All Patient Records</h4>
                        </div>
                        <div class="card-body table-full-width">
                            <table class="table" id="allPatientTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    while ($row = $resultAllPatients->fetch_assoc()) {
                                        $fullName = $row['patient_fName'] . ' ' . $row['patient_midInitial'] . ' ' . $row['patient_lName'] . ' ' . ($row['patient_suffix'] ? $row['patient_suffix'] : '');
                                        echo "<tr>";
                                        echo "<td class='text-center'>$counter</td>";
                                        echo "<td>$fullName</td>";
                                        echo "<td>{$row['created_at']}</td>";
                                        echo "<td>{$row['patient_status']}</td>";
                                        echo "<td class='td-actions'>
                                                <a href='#' data-toggle='modal' data-target='#viewModal{$row['patient_id']}' class='btn btn-info btn-link btn-xs' title='View'><i class='fa fa-eye'></i></a>
                                              </td>";
                                        echo "</tr>";

                                        // Modal for viewing patient details
                                        echo "<div class='modal fade' id='viewModal{$row['patient_id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                              <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                  <div class='modal-header'>
                                                    <h5 class='modal-title'>Patient Details - $fullName</h5>
                                                  </div>
                                                  <div class='modal-body'>
                                                    <p><strong>Age:</strong> {$row['patient_age']}</p>
                                                    <p><strong>Sex:</strong> {$row['patient_sex']}</p>
                                                    <p><strong>Address:</strong> {$row['patient_address']}</p>
                                                    <p><strong>Complaint:</strong> {$row['patient_complaint']}</p>
                                                    <p><strong>Referral:</strong> {$row['patient_referral']}</p>
                                                    <p><strong>Remarks:</strong> {$row['patient_remarks']}</p>
                                                    <p><strong>Date Registered:</strong> {$row['created_at']}</p>
                                                  </div>
                                                  <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>";
                                        $counter++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../templates/footer.php'; ?>
        </div>
    </div>
</body>

</html>
