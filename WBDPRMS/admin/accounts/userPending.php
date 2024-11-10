<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include('../../includes/admin/userManagementController.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Account Management | Pending Users</title>
  <?php include '../../templates/links.php'; ?>
</head>

<body>
  <div class="wrapper">
    <?php include '../templates/sidebar.php'; ?>
    <div class="main-panel">
      <?php include '../templates/topnav.php'; ?>
      <div class="content">
        <div class="row">
          <div class="card table-with-links">
            <div class="card-header">
              <h4 class="card-title">Pending User Registrations</h4>
              <input type="text" id="userSearchPending" class="form-control" placeholder="Search by name.">
            </div>
            <div class="card-body table-full-width">
              <table class="table" id="pendingUserTable">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Full Name</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $counter = 1;
                  while ($row = $resultPending->fetch_assoc()) {
                    $fullName = $row['user_firstName'] . ' ' . $row['user_midInitial'] . ' ' . $row['user_lastName'] . ' ' . ($row['user_suffix'] ? $row['user_suffix'] : '');
                    $age = date_diff(date_create($row['user_birthDate']), date_create('today'))->y;
                    echo "<tr>";
                    echo "<td class='text-center'>$counter</td>";
                    echo "<td>$fullName</td>";
                    echo "<td>{$row['user_sex']}</td>";
                    echo "<td>$age</td>";
                    echo "<td class='td-actions'>
                            <a href='?action=approve&user_id={$row['user_id']}' class='btn btn-success btn-link btn-xs'><i class='fa fa-check'></i></a>
                            <a href='#' data-toggle='modal' data-target='#viewModalPending{$row['user_id']}' class='btn btn-info btn-link btn-xs'><i class='fa fa-eye'></i></a>
                            <a href='?action=delete&user_id={$row['user_id']}' class='btn btn-danger btn-link btn-xs'><i class='fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    // Modal for viewing user details
                    echo "<div class='modal fade' id='viewModalPending{$row['user_id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title'>User Details - {$row['user_username']}</h5>
                                <button type='button'  class='close btn btn-danger btn-sm' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'><i class='fa fa-xmark'></i></span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <p><strong>Username:</strong> {$row['user_username']}</p>
                                <p><strong>Full Name:</strong> $fullName</p>
                                <p><strong>Sex:</strong> {$row['user_sex']}</p>
                                <p><strong>Age:</strong> $age</p>
                                <p><strong>Birthdate:</strong> {$row['user_birthDate']}</p>
                                <p><strong>Contact Number:</strong> {$row['user_contactNumber']}</p>
                                <p><strong>Address:</strong> {$row['user_address']}</p>
                                <p><strong>Date Registered:</strong> {$row['created_at']}</p>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                              </div>
                            </div>
                          </div>
                        </div>";
                    $counter++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>

  <script>
    document.getElementById('userSearchPending').addEventListener('keyup', function() {
      var searchValue = this.value.toLowerCase();
      var tableRows = document.querySelectorAll('#pendingUserTable tbody tr');
      tableRows.forEach(function(row) {
        var fullName = row.cells[1].textContent.toLowerCase();
        if (fullName.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>