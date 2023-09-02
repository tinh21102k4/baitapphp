<?php
ini_set('display_errors', 1);
require "connect.php";
$id = $_GET["id"];
$sql2 = "SELECT * FROM `post` WHERE `id` = $id";
$data2 = $connect->query($sql2);
$new = $data2->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    .error {
        color: red;
        font-size: 14px;
    }
    body{
        margin: 0px;
        padding: 0px;
    }
    .menu-web{
        padding-left: 80px;
    }
    .menu-web>ul{
        display: flex;
        align-items: center;
        gap: 3rem;
    }
    .menu-web>ul>li{
        font-size: 20px;
        list-style: none;
    }
    .menu-web>ul>li>a{
        text-decoration: none;
        color: black;
    }
    .pro>img{
        width: 100%;
        height: auto;
    }
    .pro>h4{
        margin-bottom: 0px;
    }
</style>

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
        <p class="">Chi tiết tin tức về <strong><?php echo $new['name'] ?></strong></p>
    </div>
    <div class="">
        <div class="products_1">
            <img style="width: 768px;height: auto" src="<?php echo $new['image'] ?>" alt="" srcset="">
            <h4 style="font-size: 20px"><?php echo $new['name'] ?></h4>
            <div class="des"><?php echo $new['description'] ?></div>
            <div class="content">
                <?php
                    if(!empty($new['content'])) {
                        echo $new['content'];
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