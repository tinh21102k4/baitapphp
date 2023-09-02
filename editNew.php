<?php
ini_set('display_errors', 1);
require "connect.php";

$sql = "SELECT * FROM `post`";
$data = $connect->query($sql);
$listloai = $data->fetchAll();
$id = $_GET["id"];
$sql2 = "SELECT * FROM `post` WHERE `id` = $id";
$data2 = $connect->query($sql2);
$post = $data2->fetch();

if (isset($_POST["submit-btn"])) {
    $title = $_POST["title"];
    $slug = $_POST["slug"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $anh = $_FILES["file"]["name"];

    $error = [];
    if (empty($title)) {
        $error["name"] = "Tên điện thoại không được bỏ trống";
    }
    if(empty($slug)) {
        $slug = strtolower(str_replace(' ', '-', $title));
    }
    if(!empty($slug)) {
        $slug = strtolower(str_replace(' ', '-', $slug));
    }
    if (empty($description)) {
        $error["description"] = "Trường mô tả không được bỏ trống";
    }
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
                $sql = "UPDATE `post` SET `name`='$title',`slug`='$slug',`description`='$description',`content`='$content',`image`='$up_file' WHERE `id` = $id";
                $connect->exec($sql);
            } else {
                $error['anh'] = "Có lỗi xảy ra khi tải ảnh lên";
            }
        }
    } else {
        // Thực hiện câu truy vấn UPDATE khi không có tệp ảnh mới được tải lên
        $sql = "UPDATE `post` SET `name`='$title',`slug`='$slug',`description`='$description',`content`='$content' WHERE `id` = $id";
        $connect->exec($sql);
    }

    if (empty($error)) {
        header("location:listNew.php");
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
        <h2>Sửa tin tức</h2>
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
        <input class="input_sub" type="text" name="title" value="<?php if (isset($post["name"])) echo $post["name"] ?>"><br>
        <?php if (!empty($error["title"])) echo "<p class='error'>{$error['title']}</p>" ?>

        <br><label for="">Đường dẫn</label><br>
        <input class="input_sub" type="text" name="gia" value="<?php if (isset($post["slug"])) echo $post["slug"] ?>"><br>
        <?php if (!empty($error["slug"])) echo "<p class='error'>{$error['slug']}</p>" ?>

        <br><label for="">Mô tả</label><br>
        <textarea id="editor" name="description"><?php if (isset($post["description"])) echo $post["description"] ?></textarea><br>
        <?php if (!empty($error["description"])) echo "<p class='error'>{$error['description']}</p>" ?>

        <br><label for="">Ảnh</label><br>
        <input type="file" name="file"><br>

        <br><label for="">Content</label><br>
        <textarea id="editor1" name="content"><?php if (isset($post["content"])) echo $post["content"] ?></textarea><br>

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