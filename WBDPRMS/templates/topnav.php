<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <?php if (isset($_SESSION['user_username'])): ?>
        <a class="navbar-brand">Welcome, <?php echo $title . " " . $_SESSION['user_lastname']; ?>!</a>
      <?php else: ?>
        <a class="navbar-brand">Welcome User!</a>
      <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <?php if (isset($_SESSION['user_username'])): ?>
        <a href="../../includes/logout.php" class="nav-link mr-5">Logout</a>
      <?php else: ?>
        <a href="../../user/index.php" class="nav-link mr-5">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>