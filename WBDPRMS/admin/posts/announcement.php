<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include "../../includes/admin/postEventController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Post Event</title>
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
        <!-- CONTENT Start -->

        <form action="../../includes/admin/postAnnouncementController.php" method="post">
        <textarea name="announcement_title" placeholder="Title..."></textarea><br>
        <textarea name="announcement_description" placeholder="Description..." required></textarea><br>
        <input type="submit" name="submit_announcement" value="Post">
        </form>

        <!-- CONTENT End -->
        </div>
    <?php
    include '../../templates/footer.php';
    ?>
    </div>
</div>

</body>
</html>