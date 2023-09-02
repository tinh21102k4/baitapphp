<?php
require "connect.php";
$sql = "SELECT * FROM `sanpham` limit 10";
$data = $connect->query($sql);
$list = $data->fetchAll();

$post_sql = "SELECT * FROM `post` limit 3";
$data2 = $connect->query($post_sql);
$list_post = $data2->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
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
    <div class="products_new">
        <div>
            <h3 class="logo">Sản phẩm mới</h3>
        </div>
        <div class="products">
            <?php foreach ($list as $item) { ?>
            <div class="products_1 pro">
                <figure>
                    <img src="<?php echo $item['image'] ?>" alt="" srcset="">
                </figure>
                <h4><a class="form_title" href="detail_sanpham.php?id=<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></h4>
                <div class="des_des price_pro"><p>Price :</p><?php echo $item['price'] ?> VND</div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="post_new" style="margin-top: 10px; margin-bottom: 50px">
        <div>
            <h3 class="logo">Tin tức mới</h3>
        </div>
        <div class="post_new_post">
            <?php foreach ($list_post as $post_item ) { ?>
            <div class="products_1 new">
                <figure>
                    <img src="<?php echo $post_item['image'] ?>" alt="" srcset="">
                </figure>
                <h4 style="margin-bottom: 0px"><a class="form_title" href="detail_tintuc.php?id=<?php echo $post_item['id']; ?>"><?php echo $post_item['name'] ?></a></h4>
                <div class="des_des"><?php echo $post_item['description'] ?></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php include 'layout/footer.php'?>
<script src="js/main.js"></script>
</body>

</html>