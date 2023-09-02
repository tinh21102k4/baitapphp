<?php
require "connect.php";
$sql = "SELECT `loai`.`name` AS `loai_name` , `sanpham`.* FROM `sanpham` JOIN `loai` ON `sanpham`.`id_loai` = `loai`.`id`";
$data = $connect->query($sql);
$listsanpham = $data->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
thead th,
tbody td {
    border-bottom: 2px solid green;
    padding: 5px 20px;
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
<div class="form_add">
    <h2>Thông tin sản phẩm</h2>
    <table>
        <thead>
        <tr>
            <th>Tên danh mục</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Content</th>
            <th>Image</th>
            <th>Chức năng</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($listsanpham as $item) {
            ?>
            <tr>
                <td><?php echo $item["loai_name"] ?></td>
                <td><?php echo $item["name"] ?></td>
                <td><?php echo $item["price"] ?></td>
                <td><?php echo $item["description"] ?></td>
                <td><?php echo $item["content"] ?></td>
                <td><img style="width: 200px;" src="<?php echo $item["image"] ?>" alt=""></td>
                <td><a class="delete" data-id="<?php echo $item["id"] ?>">Xoá</a>|<a style="text-decoration: none"
                            href="edit.php?id=<?php echo $item["id"] ?>">Sửa</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <br><br><br>
    <a href="add.php">Thêm sản phẩm mới</a>
</div>
    <script>

    const deleteBtns = document.querySelectorAll(".delete");
    deleteBtns.forEach(item => {
        item.addEventListener("click", () => {
            let kq = confirm("bạn có muốn xoá không?");
            if (kq) {
                let id = item.getAttribute("data-id");
                item.setAttribute("href", "delete.php?id=" + id);
            }
        })
    })
    </script>
</body>

</html>