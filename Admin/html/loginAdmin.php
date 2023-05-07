<?php
session_start();
require "../../connect.php";
$error['login_fail'] = '';
if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $checklogin = mysqli_query($connect, "SELECT * FROM admin WHERE admin_account='$name' AND admin_password = '$password'");
    $count = mysqli_num_rows($checklogin);
    if ($count == 1) {
        $_SESSION["admin_login"] = true;
        header("location:Manage/ManageProduct/CreateReadDeleteProduct.php");
    } else {
        $error['login_fail'] = 'Tài khoản mật khẩu không chính xác';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Đăng nhập</title>
</head>

<body>
    <div class="container">
        <img src="../img/pexels-jean-van-der-meulen-1457842.jpg" alt="">
        <div class="form-login">
            <form action="" method="post">
                <input required type="text" name="name" id="name" placeholder="Tên đăng nhập">
                <input required type="password" name="password" id="password" placeholder="Mật khẩu">
                <button type="submit" name="login">Đăng nhập</button>
                <p style="margin-top:10px; color:red;"><?php echo $error['login_fail']; ?></p>
                

            </form>
        </div>
    </div>
</body>

</html>
