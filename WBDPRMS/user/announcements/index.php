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
  <title>WBDPRMS - Announcements</title>
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
        <!-- CONTENT start -->
        <?php
          include '../../includes/conn.php';

          // Fetch announcements from the database
          $result = mysqli_query($mysqli, "SELECT * FROM tbl_announcement ORDER BY created_at DESC");

          while ($announcement = mysqli_fetch_assoc($result)) {
              $announcement_id = $announcement['announcement_id'];

              echo "<div>";
              echo "<h3>{$announcement['announcement_title']}</h3><br>";
              echo "<p>{$announcement['announcement_description']}</p>";
              echo "</div><hr>";
          }
          ?>
        <!-- CONTENT end -->
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>
</body>

</html>