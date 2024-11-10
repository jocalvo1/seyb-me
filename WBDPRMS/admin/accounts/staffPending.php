<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include('../../includes/admin/staffManagementController.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Account Management | Pending Staffs</title>
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
              <h4 class="card-title">Pending Staff Registrations</h4>
              <input type="text" id="staffSearchPending" class="form-control" placeholder="Search by name.">
            </div>
            <div class="card-body table-full-width">
              <table class="table" id="pendingStaffTable">
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
                    $fullName = $row['staff_firstName'] . ' ' . $row['staff_midInitial'] . ' ' . $row['staff_lastName'] . ' ' . ($row['staff_suffix'] ? $row['staff_suffix'] : '');
                    $age = date_diff(date_create($row['staff_birthDate']), date_create('today'))->y;
                    echo "<tr>";
                    echo "<td class='text-center'>$counter</td>";
                    echo "<td>$fullName</td>";
                    echo "<td>{$row['staff_sex']}</td>";
                    echo "<td>$age</td>";
                    echo "<td class='td-actions'>
                            <a href='?action=approve&staff_id={$row['staff_id']}' class='btn btn-success btn-link btn-xs'><i class='fa fa-check'></i></a>
                            <a href='#' data-toggle='modal' data-target='#viewModalPending{$row['staff_id']}' class='btn btn-info btn-link btn-xs'><i class='fa fa-eye'></i></a>
                            <a href='?action=delete&staff_id={$row['staff_id']}' class='btn btn-danger btn-link btn-xs'><i class='fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    // Modal for viewing staff details
                    echo "<div class='modal fade' id='viewModalPending{$row['staff_id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title'>Staff Details - {$row['staff_username']}</h5>
                                <button type='button'  class='close btn btn-danger btn-sm' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'><i class='fa fa-xmark'></i></span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <p><strong>Username:</strong> {$row['staff_username']}</p>
                                <p><strong>Full Name:</strong> $fullName</p>
                                <p><strong>Sex:</strong> {$row['staff_sex']}</p>
                                <p><strong>Age:</strong> $age</p>
                                <p><strong>Birthdate:</strong> {$row['staff_birthDate']}</p>
                                <p><strong>Contact Number:</strong> {$row['staff_contactNumber']}</p>
                                <p><strong>Address:</strong> {$row['staff_address']}</p>
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
    document.getElementById('staffSearchPending').addEventListener('keyup', function() {
      var searchValue = this.value.toLowerCase();
      var tableRows = document.querySelectorAll('#pendingStaffTable tbody tr');
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