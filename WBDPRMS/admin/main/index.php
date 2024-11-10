<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Home</title>
  <?php
  include '../../templates/links.php';
  ?>
</head>

<body>
  <div class="wrapper">
    <!-- SIDEBAR Start -->
    <?php
    include '../templates/sidebar.php';
    ?>
    <!-- SIDEBAR End -->
    <div class="main-panel">
      <!-- TOPNAV Start -->
      <?php
      include '../templates/topnav.php';
      ?>
      <!-- TOPNAV End -->
      <div class="content">
        <!-- Your content goes here -->
      </div>
      <?php
      include '../../templates/footer.php';
      ?>
    </div>
  </div>
</body>

</html>