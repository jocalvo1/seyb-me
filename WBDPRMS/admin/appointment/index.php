<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../index.php");
    exit();
}

include('../../includes/admin/appointmentController.php');

// Fetch all appointments from the database
$queryAllAppointments = "SELECT a.*, 
                            u.user_firstName, 
                            u.user_lastName, 
                            u.user_midInitial, 
                            u.user_username, 
                            u.user_sex, 
                            u.user_birthDate, 
                            u.user_contactNumber, 
                            u.user_address 
                        FROM tbl_appointment a 
                        JOIN tbl_user u ON a.user_id = u.user_id 
                        ORDER BY a.appointment_date ASC";

$resultAllAppointments = $mysqli->query($queryAllAppointments);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Appointments</title>
    <?php include '../../templates/links.php'; ?>
</head>

<body>
    <div class="wrapper">
        <?php include '../templates/sidebar.php'; ?>
        <div class="main-panel">
            <?php include '../templates/topnav.php'; ?>
            <div class="content">
                <div class="row">
                <?php
                // Display status update messages
                if (isset($_SESSION['status'])) {
                    echo '<div class="alert alert-success">' . $_SESSION['status'] . '</div>';
                    unset($_SESSION['status']);
                }
                ?>
                    <div class="card table-with-links">
                        <div class="card-header">
                            <h4 class="card-title">Appointments</h4>
                            <input type="text" id="appointmentSearch" class="form-control" placeholder="Search by user name or status.">
                        </div>
                        <div class="card-body table-full-width">
                            <table class="table" id="appointmentTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>Appointment Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($resultAllAppointments->num_rows > 0) {
                                        $counter = 1;
                                        while ($row = $resultAllAppointments->fetch_assoc()):
                                            // Format appointment date
                                            $formattedAppointmentDate = (new DateTime($row['appointment_date']))->format('F j, Y');

                                            // Determine status color
                                            $statusColor = '';
                                            if ($row['appointment_status'] == 'Approved') {
                                                $statusColor = 'text-black'; // Black for approved
                                            } elseif ($row['appointment_status'] == 'Pending') {
                                                $statusColor = 'text-primary'; // Blue for pending
                                            } elseif ($row['appointment_status'] == 'Declined') {
                                                $statusColor = 'text-danger'; // Red for declined
                                            }
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $counter++; ?></td>
                                                <td><?php echo $row['user_firstName'] . ' ' . $row['user_midInitial'] . ' ' . $row['user_lastName']; ?></td>
                                                <td><?php echo $formattedAppointmentDate; ?></td>
                                                <td class="<?php echo $statusColor; ?>"><?php echo ucfirst($row['appointment_status']); ?></td>
                                                <td class="td-actions">
                                                    <a href="#" data-toggle="modal" data-target="#viewModal<?php echo $row['appointment_id']; ?>" class="btn btn-info btn-link btn-xs" title="View"><i class="fa fa-eye"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#editStatusModal<?php echo $row['appointment_id']; ?>" class="btn btn-warning btn-link btn-xs" title="Edit Status"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal for Viewing Appointment Details -->
                                            <div class="modal fade" id="viewModal<?php echo $row['appointment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User Profile</h5>
                                                            <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fa fa-xmark"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Full Name:</strong> <?php echo $row['user_firstName'] . ' ' . $row['user_midInitial'] . ' ' . $row['user_lastName']; ?></p>
                                                            <p><strong>Sex:</strong> <?php echo $row['user_sex']; ?></p>
                                                            <p><strong>Age:</strong> <?php echo date_diff(date_create($row['user_birthDate']), date_create('today'))->y; ?></p>
                                                            <p><strong>Birthdate:</strong> <?php echo $row['user_birthDate']; ?></p>
                                                            <p><strong>Contact Number:</strong> <?php echo $row['user_contactNumber']; ?></p>
                                                            <p><strong>Address:</strong> <?php echo $row['user_address']; ?></p>
                                                            <p><strong>Date Registered:</strong> <?php echo $row['created_at']; ?></p>
                                                            <hr>
                                                            <p><strong>Appointment Date:</strong> <?php echo $formattedAppointmentDate; ?></p>
                                                            <p><strong>Appointment Reason:</strong> <?php echo $row['appointment_reason']; ?></p>
                                                            <p><strong>Appointment Status:</strong> <?php echo ucfirst($row['appointment_status']); ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal for Editing Appointment Status -->
                                            <div class="modal fade" id="editStatusModal<?php echo $row['appointment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Appointment Status</h5>
                                                            <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fa fa-xmark"></i></span>
                                                            </button>
                                                        </div>
                                                        <form action="../../includes/admin/appointmentController.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="appointmentStatus">Select Status:</label>
                                                                    <select name="appointment_status" class="form-control" id="appointmentStatus" required>
                                                                        <option value="Approved" <?php echo ($row['appointment_status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                                                        <option value="Declined" <?php echo ($row['appointment_status'] == 'Declined') ? 'selected' : ''; ?>>Declined</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        endwhile; 
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">No appointments found!</td></tr>';
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
        document.getElementById('appointmentSearch').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var tableRows = document.querySelectorAll('#appointmentTable tbody tr');
            tableRows.forEach(function(row) {
                var userName = row.cells[1].textContent.toLowerCase();
                var status = row.cells[3].textContent.toLowerCase();
                if (userName.includes(searchValue) || status.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
