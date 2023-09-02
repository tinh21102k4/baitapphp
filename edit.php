<?php
ini_set('display_errors', 1);
require "connect.php";

$sql = "SELECT * FROM `loai`";
$data = $connect->query($sql);
$listloai = $data->fetchAll();
$id = $_GET["id"];
$sql2 = "SELECT * FROM `sanpham` WHERE `id` = $id";
$data2 = $connect->query($sql2);
$sanpham = $data2->fetch();

if (isset($_POST["submit-btn"])) {
    $tensp = $_POST["tensp"];
    $gia = $_POST["gia"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $maloai = $_POST["loai"];

    $error = [];

    if (empty($tensp)) {
        $error["name"] = "Tên sản phẩm không được bỏ trống";
    }
    if (empty($gia)) {
        $error["price"] = "Giá sản phẩm không được bỏ trống";
    }
    if (empty($description)) {
        $error["description"] = "Mô tả sản phẩm không được bỏ trống";
    }
    if (empty($maloai)) {
        $error["maloai"] = "Loại sản phẩm không được bỏ trống";
    }

    // Kiểm tra nếu có tệp ảnh được tải lên
    if (!empty($_FILES["file"]["name"])) {
        $dir = "upload/";
        $up_file = $dir . $_FILES["file"]["name"];

        $MAX_SIZE = 500 * 1024; // 200kb
        $file_extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "png");

        if ($_FILES["file"]["size"] > $MAX_SIZE) {
            $error['anh'] = "Ảnh phải có kích thước nhỏ hơn 200KB";
        } elseif (!in_array($file_extension, $allowed_extensions)) {
            $error['anh'] = "Ảnh phải có định dạng là .jpg hoặc .png";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $up_file)) {
                // Thực hiện câu truy vấn UPDATE chỉ khi tệp ảnh đã được tải lên thành công
                $sql = "UPDATE `sanpham` SET `name`='$tensp', `price`='$gia', `description`='$description', `content`='$content', `id_loai`='$maloai', `image`='$up_file' WHERE `id` = $id";
                $connect->exec($sql);
            } else {
                $error['anh'] = "Có lỗi xảy ra khi tải ảnh lên";
            }
        }
    } else {
        // Thực hiện câu truy vấn UPDATE khi không có tệp ảnh mới được tải lên
        $sql = "UPDATE `sanpham` SET `name`='$tensp', `price`='$gia', `description`='$description', `content`='$content', `id_loai`='$maloai' WHERE `id` = $id";
        $connect->exec($sql);
    }

    if (empty($error)) {
        header("location:list.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
        <input class="input_sub" type="text" name="tensp" value="<?php if (isset($sanpham["name"])) echo $sanpham["name"] ?>"><br>
        <?php if (!empty($error["name"])) echo "<p class='error'>{$error['name']}</p>" ?>

        <br><label for="">Giá</label><br>
        <input class="input_sub" type="text" name="gia" value="<?php if (isset($sanpham["price"])) echo $sanpham["price"] ?>"><br>
        <?php if (!empty($error["price"])) echo "<p class='error'>{$error['price']}</p>" ?>

        <br><label for="">Mô tả</label><br>
        <textarea id="editor" name="description"><?php if (isset($sanpham["description"])) echo $sanpham["description"] ?></textarea><br>
        <?php if (!empty($error["description"])) echo "<p class='error'>{$error['description']}</p>" ?>

        <br><label for="">Ảnh</label><br>
        <input type="file" name="file"><br>

        <br><label for="">Content</label><br>
        <textarea id="editor1" name="content"><?php if (isset($sanpham["content"])) echo $sanpham["content"] ?></textarea><br>

        <br><label for="">Tên loại</label><br>
        <select name="loai" id="">
            <option value="">---Chọn loại---</option>
            <?php
            foreach ($listloai as $loai) {
                ?>
                <option value="<?php echo $loai["id"] ?>"
                    <?php if ($loai["id"] === $sanpham["id_loai"]) echo "selected" ?>>
                    <?php echo $loai["name"] ?></option>
                <?php
            }
            ?>
        </select><br>
        <?php if (!empty($error["maloai"])) echo "<p class='error'>{$error['maloai']}</p>" ?>

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

</html>