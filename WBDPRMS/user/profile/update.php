<?php
session_start();
if (isset($_SESSION['user_username'])) {
  $title = '';
  if (isset($_SESSION['sex'])) {
    if ($_SESSION['sex'] == 'Male') {
      $title = 'Mr.';
    } elseif ($_SESSION['sex'] == 'Female') {
      $title = 'Ma\'am';
    }
  }
} else {
    header("location: ../index.php");
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Update Profile</title>
  <?php include '../../templates/links.php'; ?>
</head>

<body>
  <div class="wrapper">
    <?php include '../../templates/sidebar.php'; ?>
    <div class="main-panel">
      <!-- TOPNAV Start -->
      <?php include '../../templates/topnav.php'; ?>
      <!-- TOPNAV End -->
      <div class="content">
        <!-- Content Start -->

        <div class="card">
                <!-- Error and Success Alerts -->
                <?php if (isset($_SESSION['error'])): ?>
                  <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                  </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                  <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                  </div>
                <?php endif; ?>
              <div class="card-header">
                <h4>Update Profile</h4>
              </div>
              <div class="card-body">

                <!-- Profile Update Form -->
                <form action="../../includes/user/updateProfileController.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="user_fName">First Name</label>
                        <input type="text" name="user_firstName" id="user_fName" class="form-control" value="<?php echo htmlspecialchars($user['user_firstName']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="user_midInitial">Middle Initial</label>
                        <input type="text" name="user_midInitial" id="user_midInitial" class="form-control" value="<?php echo htmlspecialchars($user['user_midInitial']); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="user_lName">Last Name</label>
                        <input type="text" name="user_lastName" id="user_lName" class="form-control" value="<?php echo htmlspecialchars($user['user_lastName']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="user_suffix">Suffix</label>
                        <select name="user_suffix" id="user_suffix" class="form-control">
                          <option value="">Optional</option>
                          <option value="Jr" <?php echo ($user['user_suffix'] == 'Jr') ? 'selected' : ''; ?>>Jr.</option>
                          <option value="Sr" <?php echo ($user['user_suffix'] == 'Sr') ? 'selected' : ''; ?>>Sr.</option>
                          <option value="II" <?php echo ($user['user_suffix'] == 'II') ? 'selected' : ''; ?>>II</option>
                          <option value="III" <?php echo ($user['user_suffix'] == 'III') ? 'selected' : ''; ?>>III</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="user_address">Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" value="<?php echo htmlspecialchars($user['user_address']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="user_contactNumber">Contact Number</label>
                        <input type="text" name="user_contactNumber" id="user_contactNumber" class="form-control" value="<?php echo htmlspecialchars($user['user_contactNumber']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="user_sex">Sex</label>
                        <select name="user_sex" id="user_sex" class="form-control">
                          <option value="Male" <?php echo ($user['user_sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                          <option value="Female" <?php echo ($user['user_sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="user_birthDate">Birthdate</label>
                        <input type="date" name="user_birthDate" id="user_birthDate" class="form-control" value="<?php echo htmlspecialchars($user['user_birthDate']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="user_photo">Profile Photo</label>
                      <br>
                      <div class="file-input p-2.5">
                          <input type="file" name="user_photo" id="user_photo" accept="image/*">
                      </div>
                    </div>
                  </div>

                  <div class="row text-center">
                    <div class="col-md-12">
                      <button type="submit" name="updateProfile" class="btn btn-outline-info btn-round">Update Profile</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>


        <!-- Content End -->
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>
</body>

</html>