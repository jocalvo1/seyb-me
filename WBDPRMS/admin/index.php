<?php
session_start();
if (isset($_SESSION['admin_username'])) {
  header("Location: main/index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Login</title>
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
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <div class="form-wrapper">
      <?php
      if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
      }
      ?>
      <form action="../includes/admin/adminLoginController.php" method="POST">
        <div class="form-group">
          <label for="admin_username" class="form-label">Username</label>
          <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Enter your username" required autofocus>
        </div>
        <div class="form-group mt-6">
          <label for="admin_password" class="form-label">Password</label>
          <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Enter your password" required>
        </div>
        <div class="mt-3">
          <button type="submit" class="button" name="login">login</button>
        </div>
        <div class="mt-3">
          <a href="../index.php" class="back">back</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>