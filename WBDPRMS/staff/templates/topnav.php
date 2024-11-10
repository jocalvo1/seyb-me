<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand">Welcome, <?php echo $title . " " . $_SESSION['staff_lastname']; ?>!</a>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <a href="../../includes/logout.php" class="nav-link mr-5">Logout</a>
    </div>
  </div>
</nav>