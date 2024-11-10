<div class="sidebar" data-color="white">
  <div class="logo" style="text-align: center">
    <a href="../../user/main/index.php" class="simple-text logo-normal">Barangay Rizal</a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li>
        <a href="../../user/main/index.php" style="font-size: 15px">
          <p>Home</p>
        </a>
      </li>
      <li>
        <a href="../../user/events/index.php" style="font-size: 15px">
          <p>Events</p>
        </a>
      </li>
      <li>
        <a href="../../user/announcements/index.php" style="font-size: 15px">
          <p>Announcements</p>
        </a>
      </li>
      <li>
        <a href="../../user/appointment/index.php" style="font-size: 15px">
          <p>Appointment</p>
        </a>
      </li>

      <?php if (isset($_SESSION['user_username'])): ?>
        <li>
          <a href="../../user/profile/index.php" style="font-size: 15px">
            <p>Profile</p>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</div>