<div class="sidebar" data-color="white">
  <div class="logo" style="text-align: center">
    <a href="../../admin/main/index.php" class="simple-text logo-normal">Barangay Rizal</a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li>
        <a href="../../admin/main/index.php" style="font-size: 15px">
          <p>Home</p>
        </a>
      </li>

      <hr class="my-3">

      <li>
        <a class="nav-link" data-toggle="collapse" style="font-size: 15px" href="#manageAccounts" aria-expanded="false" aria-controls="manageAccounts">
          <span class="nav-text">Manage Accounts</span>
        </a>
        <div class="collapse" id="manageAccounts">
          <ul class="nav">
            <li class="ml-3">
              <a class="nav-link" data-toggle="collapse" style="font-size: 13px" href="#manageUserAccounts" aria-expanded="false" aria-controls="manageUserAccounts">
                <span class="nav-text">Users</span>
              </a>
              <div class="collapse" id="manageUserAccounts">
                <ul class="nav">
                  <li>
                    <a class="nav-link" href="../../admin/accounts/index.php">
                      <span class="sidebar-normal ml-3">Registered</span>
                    </a>
                    <!-- if registered check icon if pending ang exclamation nga green -->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../admin/accounts/userPending.php">
                      <span class="sidebar-normal ml-3">Pending</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="ml-3">
              <a class="nav-link" data-toggle="collapse" style="font-size: 13px" href="#manageStaffAccounts" aria-expanded="false" aria-controls="manageStaffAccounts">
                <span class="nav-text">Staffs</span>
              </a>
              <div class="collapse" id="manageStaffAccounts">
                <ul class="nav">
                  <li>
                    <a class="nav-link" href="../../admin/accounts/staff.php">
                      <span class="sidebar-normal ml-3">Registered</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../admin/accounts/staffPending.php">
                      <span class="sidebar-normal ml-3">Pending</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <hr class="my-3">
      
      <li>
        <a class="nav-link" data-toggle="collapse" style="font-size: 15px" href="#managePatients" aria-expanded="false" aria-controls="managePatients">
          <span class="nav-text">Patient Records</span>
        </a>
        <div class="collapse" id="managePatients">
          <ul class="nav">
            <li>
              <a class="nav-link" href="../../admin/patient/index.php">
                <span class="sidebar-normal ml-3">Records History</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../admin/patient/addPatient.php">
                <span class="sidebar-normal ml-3">Add Record</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../admin/patient/pending.php">
                <span class="sidebar-normal ml-3">Pending Records</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <hr class="my-3">
      
      <li>
        <a class="nav-link" data-toggle="collapse" style="font-size: 15px" href="#manageAppointments" aria-expanded="false" aria-controls="manageAppointments">
          <span class="nav-text">Appointments</span>
        </a>
        <div class="collapse" id="manageAppointments">
          <ul class="nav">
            <li>
              <a class="nav-link" href="../../admin/appointment/index.php">
                <span class="sidebar-normal ml-3">Appointment Records</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../admin/appointment/pending.php">
                <span class="sidebar-normal ml-3">Pending</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      
      <li>
        <a class="nav-link" data-toggle="collapse" style="font-size: 15px" href="#managePosts" aria-expanded="false" aria-controls="managePosts">
          <span class="nav-text">Posts</span>
        </a>
        <div class="collapse" id="managePosts">
          <ul class="nav">
            <li>
              <a class="nav-link" href="../../admin/posts/index.php">
                <span class="sidebar-normal ml-3">Event</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../admin/posts/announcement.php">
                <span class="sidebar-normal ml-3">Announcement</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>