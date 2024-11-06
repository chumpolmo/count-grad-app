<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$servername = "xxx";
$username = "xxx";
$password = "xxx";
$dbname = "xxx";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>