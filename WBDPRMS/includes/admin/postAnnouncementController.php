<?php
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_announcement'])) {
    $title = $_POST['announcement_title'];
    $description = $_POST['announcement_description'];

    // Insert post into the database
    $query = "INSERT INTO tbl_announcement (announcement_title, announcement_description) VALUES ('$title', '$description')";
    mysqli_query($mysqli, $query);
    header('Location: ../../admin/posts/announcement.php');
}
