<?php
session_start();

if (isset($_SESSION['user_username'])) {
  header("Location: main/index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User - Login</title>
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

<body>
  <div class="container">
    <div class="form-wrapper">
      <?php
      if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
      }
      if (isset($_SESSION['pending'])) {
        echo "<div class='alert alert-info'>" . $_SESSION['pending'] . "</div>";
        unset($_SESSION['pending']);
      }
      ?>
      <form action="../includes/user/userLoginController.php" method="POST">
        <div class="form-group">
          <label for="user_name" class="form-label">Username</label>
          <input type="text" class="form-control" id="user_name" name="user_username" placeholder="Enter your username" required autofocus>
        </div>
        <div class="form-group mt-6">
          <label for="user_pass" class="form-label">Password</label>
          <input type="password" class="form-control" id="user_pass" name="user_password" placeholder="Enter your password" required>
        </div>
        <div class="mt-3">
          <button type="submit" class="button" name="login">login</button>
        </div>
        <div class="mt-3">
          <a href="../index.php" class="back">back</a>
        </div>
        <div class="mt-3 links">
          <a href="./register.php" class="text-neutral500">Register</a>
          <a href="main/index.php" class="ml-auto text-neutral500">Login as guest</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>