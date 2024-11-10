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
  <title>WBDPRMS - Events</title>
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
        <!-- Content goes here -->

        <?php
          include '../../includes/conn.php';

          // Fetch posts from the database
          $result = mysqli_query($mysqli, "SELECT * FROM tbl_post ORDER BY created_at DESC");

          while ($post = mysqli_fetch_assoc($result)) {
              $post_id = $post['post_id'];

              echo "<div>";
              echo "<p>{$post['post_description']}</p>";
              if ($post['post_image']) {
                  echo "<img src='../../pictures/events/{$post['post_image']}' alt='Post image' style='width:100%;height:auto;'>";
              }
              echo "</div><hr>";
          }
          ?>



      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>
</body>

</html>