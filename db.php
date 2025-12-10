<?php
$servername = "localhost";
$username = "root"; // Thay bằng tên người dùng MySQL của bạn
$password = ""; // Thay bằng mật khẩu MySQL của bạn
$dbname = "caulong"; // Tên cơ sở dữ liệu của bạn
// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
