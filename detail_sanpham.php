<?php
ini_set('display_errors', 1);
require "connect.php";
$id = $_GET["id"];
$sql2 = "SELECT * FROM `sanpham` WHERE `id` = $id";
$data2 = $connect->query($sql2);
$sanpham = $data2->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="css/style.css">
</head>



<body>
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
                    <li><input class="search" type="text" placeholder="tìm kiếm"><span class="tim_kiem"><button>Tìm kiếm</button></span></li>
                    <li><a href="login.php">Đăng nhập</a></li>
                <?php } else { ?>
                    <li>
                        <div><a href="user.php" class="logout admin">Admin</a></div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php include './layout/banner.php'?>
    <div class="post_new" style="margin-top: 10px">
        <div style="margin-top: 50px">
            <p>Chi tiết sản phẩm <strong><?php echo $sanpham['name'] ?></strong></p>
        </div>
        <div class="">
            <div class="products_1">
                <div class="imag_add_btn">
                    <div class="image_detail_sp">
                        <img style="width: 768px;height: auto" src="<?php echo $sanpham['image']?>" alt="" srcset="">
                    </div>
                    <div class="products_buy_detail">
                        <span>Thêm sản phẩm vào giỏ hàng</span></br>
                        <h4>Tên sản phẩm : <?php echo $sanpham['name'] ?></h4>
                        <p>Price : <?php echo $sanpham['price'] ?></p>
                        <button class="btn_add_detail" type="submit">Thêm</button>
                    </div>
                </div>

                <h4><?php echo $sanpham['name'] ?></h4>
                <div class="description"><?php echo $sanpham['description'] ?></div>
                <div class="content">
                    <?php
                        if(!empty($sanpham['content'])) {
                            echo $sanpham['content'];
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "./layout/footer.php"; ?>
    <script src="js/main.js"></script>
</body>

</html>