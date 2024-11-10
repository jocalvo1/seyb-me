<?php
$database_host = "localhost";
$database_port = 3306;
$database_user = "root";
$database_pass = "";
$database_name = "db_wbdprms";

$mysqli = new mysqli($database_host, $database_user, $database_pass, $database_name);
if ($mysqli->connect_error) {
  die("Connection Failed" . $mysqli->connect_error);
}
