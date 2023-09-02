<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login-đăng nhập</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container_form{
            width: 768px;
            margin: 0px auto;
            margin-top: 100px;
        }
        .form_input{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form_input>label{
            width: 20%;
        }
        .form_input>input{
            width: 50%;
        }
        .mt-4{
            margin-top: 30px;
        }
        .btn{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            padding-left: 175px;
        }
    </style>
</head>
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
<?php
if (isset($_POST['dang_xuat'])) {
    unset($_SESSION['user']);
    header("Location: login.php");
}
?>
</body>
</html>