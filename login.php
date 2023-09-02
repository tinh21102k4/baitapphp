<?php session_start(); 

?>
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
            height: 25px;
            border: 1px solid;
            border-radius: 5px;
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
                <li><a href="login.php">Đăng nhập</a></li>
            </ul>
        </div>
    </div>

    <div class="container_form">
        <h3 style="text-align: center ; padding-left: 175px;">Form login</h3>
        <form action="" method="POST">
            <div class="form_input">
                <label>Username :</label> <input type="text" name="username" /></br>
            </div>

            <div class="form_input mt-4">
                <label>Password :</label> <input type="password" name="password"></br>
            </div>
            <div class="btn">
                <input type="submit" name="dangnhap" value="Đăng nhập"/>
                <input type="submit" name="dangki" value="dang ki">
            </div>
        </form>
    </div>

<?php
if (isset($_POST['dangnhap'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin" && $password == "123456") {
        $_SESSION['user'] = $username;
        header("Location: user.php");
    } else {
        echo "Lêu lêu sai rồi";
    }
}
?>
</body>
</html>