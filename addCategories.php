<?php
require "connect.php";
$sql = "SELECT * FROM `loai`";
$data = $connect->query($sql);
$listloai = $data->fetchAll();

if (isset($_POST["submit-btn"])) {
    $tendt = $_POST["tendm"];

    $error = [];
    if (empty($tendt)) {
        $error["tendm"] = "Không được để trống danh mục";
    }
    if (empty($error)) {
        $sql = "INSERT INTO `loai`(`name`) VALUES ('$tendt')";
        $connect->exec($sql);
        header("location:listCategories.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
.error {
    color: red;
    font-size: 14px;
}
</style>

<body>
<?php
session_start();
// nếu tồn tại session user thì cho vào còn không thì cút
if (!isset($_SESSION['user'])) {
    echo "Bạn không có quyền truy cập trang này";
    die;
}
?>
<div class="container_web">
    <div class="logo">
        <img src="image/logo_fpt.png" alt="" srcset="">
    </div>
    <div class="menu-web">
        <ul>
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="tintuc.php">Tin tức</a></li>
            <li><a href="sanpham.php">Sản phẩm</a></li>
        </ul>
    </div>
    <div class="form_login">
        <ul>
            <?php if(!isset($_SESSION['user'])) { ?>
                <li><a href="login.php">Đăng nhập</a></li>
            <?php } else { ?>
                <li>
                    <form action="" method="POST">
                        <input class="logout" type="submit" name="dang_xuat" value="Đăng xuất">
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="alter_form_list">
    <?php include 'quanly_crud.php'?>
</div>
<div class="alter_form_list">
    <ul>
        <h2>Nhập thông tin sản phẩm</h2>
    </ul>
</div>
<?php
if (isset($_POST['dang_xuat'])) {
    unset($_SESSION['user']);
    header("Location: login.php");
}
?>
<div class="form_add">
    <form action="" enctype="multipart/form-data" method="POST">
        <label for="">Tên sản phẩm</label><br>
        <input class="input_sub" type="text" name="tendm" value="<?php if (isset($_POST["tendm"])) echo $_POST["tendm"] ?>"><br>
        <?php if (!empty($error["tendm"])) echo "<p class='error'>{$error['tendm']}</p>" ?>

        <br><input type="submit" name="submit-btn" value="Thêm" style="margin-bottom: 100px">
    </form>
</div>
<script src="ckeditor/ckeditor.js"></script>
<script>
    // Kích hoạt CKEditor trên textarea có id="editor"
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>
</body>

</html>