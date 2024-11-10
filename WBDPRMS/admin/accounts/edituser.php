<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include '../../includes/conn.php';

if (isset($_GET['user_id'])) {
  $userId = $_GET['user_id'];

  // Fetch the user details based on user_id
  $sql = "SELECT * FROM tbl_user WHERE user_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();

  // Check if user exists
  if (!$user) {
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
  <title>WBDPRMS - Account Management | Edit User</title>
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
              <h4 class="card-title">Edit User - <?php echo $user['user_username']; ?></h4>
            </div>
            <div class="card-body table-full-width">
              <form action="../../includes/admin/userManagementController.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label for="user_fName">First Name</label>
                      <input type="text" name="user_firstName" id="user_fName" class="form-control" value="<?php echo $user['user_firstName']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label for="user_midInitial">Middle Initial</label>
                      <input type="text" name="user_midInitial" id="user_midInitial" class="form-control" value="<?php echo $user['user_midInitial']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label for="user_lName">Last Name</label>
                      <input type="text" name="user_lastName" id="user_lName" class="form-control" value="<?php echo $user['user_lastName']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label for="user_suffix">Name Suffix</label>
                      <select name="user_suffix" id="user_suffix" class="form-control">
                        <!-- If the suffix is empty, select "Optional" -->
                        <option value="" <?php echo ($user['user_suffix'] == '') ? 'selected' : ''; ?>>Optional</option>
                        <!-- Pre-select the user's suffix if it exists -->
                        <option value="Jr" <?php echo ($user['user_suffix'] == 'Jr') ? 'selected' : ''; ?>>Jr.</option>
                        <option value="Sr" <?php echo ($user['user_suffix'] == 'Sr') ? 'selected' : ''; ?>>Sr.</option>
                        <option value="II" <?php echo ($user['user_suffix'] == 'II') ? 'selected' : ''; ?>>II</option>
                        <option value="III" <?php echo ($user['user_suffix'] == 'III') ? 'selected' : ''; ?>>III</option>
                        <option value="IV" <?php echo ($user['user_suffix'] == 'IV') ? 'selected' : ''; ?>>IV</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="user_bDay">Birthdate</label>
                      <input type="date" class="form-control" id="user_bDay" name="user_birthDate" value="<?php echo $user['user_birthDate']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="user_number">Contact Number</label>
                      <input type="text" class="form-control" id="user_number" name="user_contactNumber" value="<?php echo $user['user_contactNumber']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="user_sex">Sex</label>
                      <select name="user_sex" id="user_sex" class="form-control" required>
                        <option value="Male" <?php if ($user['user_sex'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($user['user_sex'] == 'Female') echo 'selected'; ?>>Female</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label for="user_address">Address</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $user['user_address']; ?>" required>
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