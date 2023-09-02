<?php
require "connect.php";
$sql = "SELECT * FROM `loai`";
$data = $connect->query($sql);
$listloai = $data->fetchAll();

if (isset($_POST["submit-btn"])) {
    $tendt = $_POST["tensp"];
    $gia = $_POST["gia"];
    $description = $_POST["description"];
    $mau = $_POST["content"];
    $maloai = $_POST["loai"];
    $anh = $_FILES["file"]["name"];

    $error = [];
    if (empty($tendt)) {
        $error["tensp"] = "Tên sản phẩm không được bỏ trống";
    }
    if (empty($gia)) {
        $error["gia"] = "Giá sản phẩm không được bỏ trống";
    } else if(intval($gia) < 0) {
        $error["gia"] = "Giá sản phẩm phải lớn hơn 0";
    }
    if (empty($description)) {
        $error["description"] = "Mô tả không được bỏ trống";
    }
    if (empty($maloai)) {
        $error["maloai"] = "Loại sản phẩm không được bỏ trống";
    }
    
    $dir = "upload/";
    $up_file = $dir . $_FILES["file"]["name"];
    
    // $MAX_SIZE  = 2 * 1024 * 1024; //  2MB
    $MAX_SIZE  = 500 * 1024; //  200kb
    
    $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $allowed_extensions = array("jpg", "png");

    if (empty($anh)) {
        $error["anh"] = "Ảnh điện thoại không được bỏ trống";
    } else if (filesize($_FILES['file']['tmp_name']) > $MAX_SIZE ) {
        $error['anh'] = "Ảnh phải có size nhỏ hơn 2MB";
    } else if(!in_array($file_extension, $allowed_extensions)) {
        $error['anh'] = "Ảnh phải có định dạng là .jpg hoặc .png";
    }



    
    if (empty($error)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $up_file)) {
            echo "Done";
        } else {
            echo "Fail";
        }
        $sql = "INSERT INTO `sanpham`(`name`, `price`, `description`, `image`, `content`, `id_loai`) VALUES ('$tendt','$gia','$description','$up_file','$mau','$maloai')";
        $connect->exec($sql);
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
        <input class="input_sub" type="text" name="tensp" value="<?php if (isset($_POST["tendt"])) echo $_POST["tensp"] ?>"><br>
        <?php if (!empty($error["tensp"])) echo "<p class='error'>{$error['tensp']}</p>" ?>

        <br><label for="">Giá</label><br>
        <input class="input_sub" type="text" name="gia" value="<?php if (isset($_POST["gia"])) echo $_POST["gia"] ?>"><br>
        <?php if (!empty($error["gia"])) echo "<p class='error'>{$error['gia']}</p>" ?>

        <br><label for="">Mô tả</label><br>
        <textarea id="editor" name="description"><?php if (isset($_POST["description"])) echo $_POST["description"] ?></textarea><br>
        <?php if (!empty($error["description"])) echo "<p class='error'>{$error['description']}</p>" ?>

        <br><label for="">Ảnh</label><br>
        <input type="file" name="file"><br>
        <?php if (!empty($error["anh"])) echo "<p class='error'>{$error['anh']}</p>" ?>

        <br><label for="">Content</label><br>
        <textarea id="editor1" name="content"><?php if (isset($_POST["content"])) echo $_POST["content"] ?></textarea><br>

        <br><label for="">Tên loại</label><br>
        <select name="loai" id="">
            <option value="">---Chọn danh mục sản phẩm---</option>
            <?php
            foreach ($listloai as $loai) {
                ?>
                <option value="<?php echo $loai["id"] ?>"
                    <?php if (isset($_POST["loai"]) && $_POST['loai'] == $loai["name"]) echo "selected" ?>>
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