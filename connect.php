<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL (thường là localhost nếu MySQL cài đặt trên cùng máy)
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "assignment2"; // Tên cơ sở dữ liệu bạn muốn kết nối

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


?>
