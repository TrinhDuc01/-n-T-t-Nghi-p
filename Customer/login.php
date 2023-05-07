<?php
session_start();
require "../connect.php";
$error['account'] = '';

//chuc nang dang nhap
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM customer WHERE customer_email = '$email' AND customer_password = '$password'";
    $rows = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($rows);
    if ($count == 1) {
        $info_user = mysqli_fetch_array($rows);
        $_SESSION['login']['customer_fullname'] = $info_user['customer_fullname'];
        $_SESSION['login']['customer_id'] = $info_user['customer_id'];
        $_SESSION['login']['customer_email'] = $info_user['customer_email'];
        //         echo '<pre>';
// print_r($_SESSION['login']);
        header('location:../index.php');
    } else {
        $error['account'] = 'Tài khoản mật khẩu không chính xác';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <h1><a href="../index.php"><i class="fa-solid fa-house-chimney"></i></a> Đăng nhập</h1>
            <form method="post">
                <div class="form-control">
                    <input type="email" required name="email" id="" placeholder="Email">
                    <span></span>
                    <div></div>
                </div>
                <div class="form-control">
                    <input class="password" type="password" required name="password" id="" placeholder="Mật khẩu">
                    <button type="button" class="showHide" onclick="showHidePass(0)"><i
                            class="fa-solid fa-eye-slash"></i></button>
                    <span></span>
                    <div class="error">
                        <?php echo $error['account']; ?>
                    </div>
                </div>
                <button type="submit" name="login" class="btn-submit">Đăng nhập</button>
            </form>
            <div class="link">

                Chưa có tài khoản? <a href="./register.php">Đăng kí</a>
            </div>
        </div>
    </div>


    <script src="../js/showHidePassword.js"></script>
</body>

</html>
<?php
mysqli_close($connect);
?>