<?php
require "connect.php";
try {
    $id = $_GET["id"];
    $sql = "DELETE FROM loai WHERE `loai`.`id` = $id";
    $connect->exec($sql);
    header("location:listCategories.php");
} catch (PDOException $e) {
    // Xử lý lỗi xóa bản ghi hoặc bảng nếu có
    $error_message = $e->getMessage();
    echo "Không thể xóa bản ghi hoặc bảng này bởi vì có có mối quan hệ rằng buộc </br>: " . $error_message . 'vui lòng quay trở lại trang ';
    echo '<br><a href="javascript:history.go(-1)">Quay lại trang trước</a>';
}
?>