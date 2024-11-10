<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../index.php");
    exit();
}

include('../../includes/admin/appointmentController.php');

// Fetch pending appointments from the database
$queryPendingAppointments = "SELECT a.*, u.user_firstName, u.user_lastName, u.user_midInitial, u.user_username, u.user_sex, u.user_birthDate, u.user_contactNumber, u.user_address 
                             FROM tbl_appointment a 
                             JOIN tbl_user u ON a.user_id = u.user_id 
                             WHERE a.appointment_status = 'pending' 
                             ORDER BY a.appointment_date ASC";

$resultPendingAppointments = $mysqli->query($queryPendingAppointments);

// Initialize an array to hold all appointments
$appointments = [];

// Fetch all appointments into a single array
while ($row = $resultPendingAppointments->fetch_assoc()) {
    $appointments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Appointment Management | Pending Appointments</title>
    <?php include '../../templates/links.php'; ?>
</head>

<body>
    <div class="wrapper">
        <?php include '../templates/sidebar.php'; ?>
        <div class="main-panel">
            <?php include '../templates/topnav.php'; ?>
            <div class="content">   
            <?php
            // Display status update messages
            if (isset($_SESSION['status'])) {
                echo '<div class="alert alert-success">' . $_SESSION['status'] . '</div>';
                unset($_SESSION['status']);
            }
            ?>
                <div class="row">
                    <div class="card table-with-links">
                        <div class="card-header">
                            <h4 class="card-title">Pending Appointments</h4>
                            <input type="text" id="searchPendingAppointments" class="form-control" placeholder="Search by name.">
                        </div>
                        <div class="card-body table-full-width">
                            <table class="table" id="displayPendingAppointments">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>Appointment Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($appointments)) {
                                        echo '<tr><td colspan="4" class="text-center">No pending appointments!</td></tr>';
                                    } else {
                                        $counter = 1;
                                        foreach ($appointments as $row):
                                            $formattedAppointmentDate = (new DateTime($row['appointment_date']))->format('F j, Y');
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $counter++; ?></td>
                                                <td><?php echo $row['user_firstName'] . ' ' . $row['user_midInitial'] . ' ' . $row['user_lastName']; ?></td>
                                                <td><?php echo $formattedAppointmentDate; ?></td>
                                                <td class="td-actions">
                                                    <a href='?action=approve&appointment_id=<?php echo $row['appointment_id']; ?>' class='btn btn-success btn-link btn-xs' title="Approve"><i class='fa fa-check'></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#viewModal<?php echo $row['appointment_id']; ?>" class='btn btn-info btn-link btn-xs' title="View"><i class='fa fa-eye'></i></a>
                                                    <a href='?action=decline&appointment_id=<?php echo $row['appointment_id']; ?>' class='btn btn-danger btn-link btn-xs' title="Decline"><i class='fa fa-times'></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal for Viewing Appointment Details -->
                                            <div class="modal fade" id="viewModal<?php echo $row['appointment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User Details - <?php echo $row['user_username']; ?></h5>
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
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php endforeach; ?>
                                    <?php } ?>
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
        document.getElementById('searchPendingAppointments').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            // Get all appointment tables
            var tableRows = document.querySelectorAll('#displayPendingAppointments tbody tr');

            tableRows.forEach(function(row) {
                var fullName = row.cells[1].textContent.toLowerCase();
                row.style.display = fullName.includes(searchValue) ? '' : 'none'; // Show or hide row
            });
        });
    </script>

</body>

</html>
