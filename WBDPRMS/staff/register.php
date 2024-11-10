<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: main/index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff - Register</title>
  <link rel="icon" href="../../pictures/Sunn.png">
  <link rel="stylesheet" href="../styles/reset.css">
  <link rel="stylesheet" href="../styles/vars.css">
  <link rel="stylesheet" href="../styles/borders.css">
  <link rel="stylesheet" href="../styles/colors.css">
  <link rel="stylesheet" href="../styles/forms.css">
  <link rel="stylesheet" href="../styles/margins.css">
  <link rel="stylesheet" href="../styles/paddings.css">
  <link rel="stylesheet" href="../styles/utils.css">
  <!--Frameworks-->
  <link rel="stylesheet" href="../styles/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/tim.css">
  <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: rgba(245, 245, 245, 1)">

  <div class="container">
    <div class="content">
      <div class="row">
        <div class="card card-user">
          <div class="card-header">
            <h5 class="card-title">Register an Account!</h5>
          </div>
          <div class="card-body">
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
            <form action="../includes/staff/staffRegistrationController.php" enctype="multipart/form-data" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="staff_username" placeholder="Enter Your Desired Username ..." required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="staff_password" placeholder="Enter your desired password ..." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="staff_firstName" id="firstname" class="form-control" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="midinitial">Middle Initial</label>
                    <input type="text" name="staff_midInitial" id="midinitial" class="form-control" placeholder="Middle Initial" required>
                  </div>
                </div>
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="staff_lastName" id="lastname" class="form-control" placeholder="Last Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="suffix">Name Suffix</label>
                    <select name="staff_suffix" id="suffix" class="form-control">
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bday">Birthdate</label>
                    <input type="date" class="form-control" id="bday" name="staff_birthDate" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="number">Contact Number</label>
                    <input type="text" class="form-control" id="number" name="staff_contactNumber" placeholder="Your Phone Number" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sex">Sex</label>
                    <select name="staff_sex" class="form-control" id="sex" required>
                      <option value="" disabled selected hidden>Select your sex</option>
                      <option value="Male">Male ( M )</option>
                      <option value="Female">Female ( F )</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="staff_address" placeholder="Your Full Address (Street, Barangay, City, Province)" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="photo">Upload Your Photo (ID photo, e.g., 2x2)</label>
                  <br>
                  <div class="p-2.5 file-input">
                    <input type="file" name="staff_photo" id="photo" accept="image/*" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                  <button type="submit" name="register" class="btn btn-primary btn-round">Register</button>
                  <span class="ml-auto text-neutral500">Already have an account? <a href="index.php" id="login">Login</a></span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>