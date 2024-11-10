<?php
require('../../includes/staff/patientManagementController.php');

$title = '';
if (isset($_SESSION['sex'])) {
  if ($_SESSION['sex'] == 'Male') {
    $title = 'Mr.';
  } elseif ($_SESSION['sex'] == 'Female') {
    $title = 'Ma\'am';
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Add Patient</title>
  <?php include '../../templates/links.php'; ?>
</head>

<body>
  <div class="wrapper">
    <!-- SIDEBAR Start -->
    <?php include '../templates/sidebar.php'; ?>
    <!-- SIDEBAR End -->
    <div class="main-panel">
      <!-- TOPNAV Start -->
      <?php include '../templates/topnav.php'; ?>
      <!-- TOPNAV End -->
      <div class="content">

        <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
          unset($_SESSION['success']);
        }
        ?>
        <!-- CONTENT Start -->
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add a New Patient Record</h4>
          </div>
          <div class="card-body">
            <form action="../../includes/patient/patientManagementController.php" method="post">
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="patient_fName">First Name</label>
                    <input type="text" name="patient_fName" id="patient_fName" class="form-control" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="patient_midInitial">Middle Initial</label>
                    <input type="text" name="patient_midInitial" id="patient_midInitial" class="form-control" placeholder="Middle Initial">
                  </div>
                </div>
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="patient_lName">Last Name</label>
                    <input type="text" name="patient_lastName" id="patient_lName" class="form-control" placeholder="Last Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="patient_suffix">Name Suffix</label>
                    <select name="patient_suffix" id="patient_suffix" class="form-control">
                      <option value="" disabled selected hidden>Optional</option>
                      <option value="Jr">Jr.</option>
                      <option value="Sr">Sr.</option>
                      <option value="II">II</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="patient_age">Age</label>
                    <input type="number" name="patient_age" id="patient_age" class="form-control" placeholder="Age" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="patient_sex">Sex</label>
                    <select name="patient_sex" id="patient_sex" class="form-control" required>
                      <option value="" disabled selected hidden>Sex</option>
                      <option value="Male">Male ( M )</option>
                      <option value="Female">Female ( F )</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="patient_address">Address</label>
                    <input type="text" class="form-control" id="patient_address" name="patient_address" placeholder="Full Address (Street, Barangay, City, Province)" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="patient_complaint">Chief Complaint</label>
                  <input type="text" class="form-control" id="patient_complaint" name="patient_complaint" placeholder="Patient's Complaint ... " required>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="patient_referral">Referral Place</label>
                  <input type="text" class="form-control" id="patient_referral" name="patient_referral" placeholder="Place of referral ... " required>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="patient_remarks">Remarks</label>
                  <input type="text" class="form-control" id="patient_remarks" name="patient_remarks" placeholder="Remarks ...">
                </div>
              </div>
              <button type="submit" name="add_record" class="btn btn-primary btn-round">Add Record</button>
            </form>
          </div>
        </div>
        <!-- CONTENT End -->
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>
</body>

</html>
