<?php
session_start();
session_unset();
session_destroy();

// Redirect to the main page, which is two directories back
header("Location: http://localhost/WBDPRMS/index.php");
exit();
