<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include '../../includes/conn.php';

if (isset($_GET['staff_id'])) {
  $staffId = $_GET['staff_id'];

  // Fetch the staff details based on staff_id
  $sql = "SELECT * FROM tbl_staff WHERE staff_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $staffId);
  $stmt->execute();
  $result = $stmt->get_result();
  $staff = $result->fetch_assoc();
  $stmt->close();

  // Check if staff exists
  if (!$staff) {
    echo "User not found.";
    exit();
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Account Management | Edit Staff</title>
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
              <h4 class="card-title">Edit Staff - <?php echo $staff['staff_username']; ?></h4>
            </div>
            <div class="card-body table-full-width">
              <form action="../../includes/admin/staffManagementController.php" method="POST">
                <input type="hidden" name="staff_id" value="<?php echo $staff['staff_id']; ?>">

                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label for="staff_fName">First Name</label>
                      <input type="text" name="staff_firstName" id="staff_fName" class="form-control" value="<?php echo $staff['staff_firstName']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label for="staff_midInitial">Middle Initial</label>
                      <input type="text" name="staff_midInitial" id="staff_midInitial" class="form-control" value="<?php echo $staff['staff_midInitial']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label for="staff_lName">Last Name</label>
                      <input type="text" name="staff_lastName" id="staff_lName" class="form-control" value="<?php echo $staff['staff_lastName']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label for="staff_suffix">Name Suffix</label>
                      <select name="staff_suffix" id="staff_suffix" class="form-control">
                        <!-- If the suffix is empty, select "Optional" -->
                        <option value="" <?php echo ($staff['staff_suffix'] == '') ? 'selected' : ''; ?>>Optional</option>
                        <!-- Pre-select the staff's suffix if it exists -->
                        <option value="Jr" <?php echo ($staff['staff_suffix'] == 'Jr') ? 'selected' : ''; ?>>Jr.</option>
                        <option value="Sr" <?php echo ($staff['staff_suffix'] == 'Sr') ? 'selected' : ''; ?>>Sr.</option>
                        <option value="II" <?php echo ($staff['staff_suffix'] == 'II') ? 'selected' : ''; ?>>II</option>
                        <option value="III" <?php echo ($staff['staff_suffix'] == 'III') ? 'selected' : ''; ?>>III</option>
                        <option value="IV" <?php echo ($staff['staff_suffix'] == 'IV') ? 'selected' : ''; ?>>IV</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="staff_bDay">Birthdate</label>
                      <input type="date" class="form-control" id="staff_bDay" name="staff_birthDate" value="<?php echo $staff['staff_birthDate']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="staff_number">Contact Number</label>
                      <input type="text" class="form-control" id="staff_number" name="staff_contactNumber" value="<?php echo $staff['staff_contactNumber']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="staff_sex">Sex</label>
                      <select name="staff_sex" id="staff_sex" class="form-control" required>
                        <option value="Male" <?php if ($staff['staff_sex'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($staff['staff_sex'] == 'Female') echo 'selected'; ?>>Female</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label for="staff_address">Address</label>
                    <input type="text" class="form-control" id="staff_address" name="staff_address" value="<?php echo $staff['staff_address']; ?>" required>
                  </div>
                </div>

                <div class="row">
                  <div class="col d-flex justify-content-between align-items-center">
                    <button type="submit" name="update" class="btn btn-primary btn-round">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>

</body>

</html>