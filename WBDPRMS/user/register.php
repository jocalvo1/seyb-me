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
  <title>User - Register</title>
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
            <form action="../includes/user/userRegistrationController.php" enctype="multipart/form-data" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="user_username" placeholder="Enter Your Desired Username ..." required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="user_password" placeholder="Enter your desired password ..." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="user_fName">First Name</label>
                    <input type="text" name="user_firstName" id="user_fName" class="form-control" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="user_midInitial">Middle Initial</label>
                    <input type="text" name="user_midInitial" id="user_midInitial" class="form-control" placeholder="Middle Initial" required>
                  </div>
                </div>
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="user_lName">Last Name</label>
                    <input type="text" name="user_lastName" id="user_lName" class="form-control" placeholder="Last Name" required>
                  </div>
                </div>
                <div class="col-md-2 pr-1">
                  <div class="form-group">
                    <label for="user_suffix">Name Suffix</label>
                    <select name="user_suffix" id="user_suffix" class="form-control">
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
                    <label for="user_bDay">Birthdate</label>
                    <input type="date" class="form-control" id="user_bDay" name="user_birthDate" placeholder="Date" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="user_number">Contact Number</label>
                    <input type="text" class="form-control" id="user_number" name="user_contactNumber" placeholder="Your Phone Number" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="user_sex">Sex</label>
                    <select name="user_sex" id="user_sex" class="form-control" required>
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
                    <label for="user_address">Address</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Your Full Address (Street, Barangay, City, Province)" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="user_photo">Upload Your Photo ( ID photo [ ex. 2x2 ] )</label>
                  <br>
                  <div class="p-2.5 file-input">
                    <input type="file" name="user_photo" id="user_photo" accept="image/*" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                  <button type="submit" name="register" class="btn btn-primary btn-round">Register</button>
                  <a href="main/index.php" class="ml-auto text-neutral500">Login as guest!</a>
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