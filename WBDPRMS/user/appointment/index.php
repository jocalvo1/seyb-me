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
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Appointment</title>
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

        <!-- CONTENT Start -->

        <?php if (isset($_SESSION['user_username'])): ?>
          <div class="row">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Book an Appointment!</h5>
              </div>
              <div class="card-body">
                <!-- Alert if the appointment was successful or not -->
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
                <form method="POST" action="../../includes/user/userAppointmentController.php">

                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="user_appointment" name="user_appointmentReason" style="height: 100px"></textarea required>
                    <label for="user_appointment">Reason For Appointment</label>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="appointment_date">Appointment Date:</label>
                        <input type="date" class="form-control" name="appointment_date" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col d-flex justify-content-between align-items-center">
                      <button type="submit" name="book_appointment" class="btn btn-primary btn-round">Book Appointment</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="card">
            <div class="card-body">
              <span>You need login first to book for an appointment. <a href="../index.php">Login!</a></span>
            </div>
          </div>
        <?php endif; ?>

        <!-- CONTENT End -->

      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>
</body>

</html>