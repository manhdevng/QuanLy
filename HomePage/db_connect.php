<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrm_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

date_default_timezone_set('Asia/Ho_Chi_Minh');

$conn->query("SET time_zone = '+07:00'");

?>