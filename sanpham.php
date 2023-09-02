<?php
require "connect.php";
$sql = "SELECT * FROM `sanpham`";
$data = $connect->query($sql);
$listsanpham = $data->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
</head>
<link rel="stylesheet" href="css/style.css">

<style>
    .error {
        color: red;
        font-size: 14px;
    }
    .logo>img{
        width: 145px;
    }
    body{
        margin: 0px;
        padding: 0px;
    }
    /* .menu-web{
        padding-left: 80px;
    } */
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
    .menu-web>ul>li>a:hover{
        color: red;
    }
    .products{
        padding-left: 40px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem;
    }
    .products_new{
        width: 1246px;
        margin: 0px auto;
        margin-top: 60px;
    }
    .post_new{ 
        width: 1246px;
        margin: 0px auto;
        margin-top: 60px;
    }
    .pro{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .pro>img{
        width: 100%;
        height: 350px;
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
    <div class="products_new">
        <div>
            <h3 class="logo">Sản phẩm mới</h3>
        </div>
        <div class="products">
            <?php foreach ($listsanpham as $item) { ?>
            <div class="products_1 pro">
                <img src="<?php echo $item['image'] ?>" alt="" srcset="">
                <h4><a class="form_title" href="detail_sanpham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h4>
                <div class="des_des price_pro"><p>Price :</p><?php echo $item['price'] ?> VND</div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php include "./layout/footer.php"; ?>
    <script src="js/main.js"></script>
</body>

</html>