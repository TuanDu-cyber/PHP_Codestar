<?php
//Kết nối database
// 1. Khai báo biến
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanly_sanpham";

// 2. Khởi tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>