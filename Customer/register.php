<?php
session_start();
require "../connect.php";
$error['username'] = '';
$error['confirm_password'] = '';
$error['phone'] = '';

//chuc nang dang ky
if (isset($_POST['register'])) {
    $email = $_POST['email_name'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = NULL;

    $rows = mysqli_query($connect, "SELECT * FROM customer WHERE customer_email = '$email'");
    $count = mysqli_num_rows($rows);
    if ($password != $confirm_password) {
        $error['confirm_password'] = 'Mật khẩu xác nhận không chính xác!';
    } 
    elseif(!is_numeric($phone)){
        $error['phone'] = 'Bạn phải nhập số!';
    }
    else {
        if ($count == 1) {
            $error['username'] = 'Tên tài khoản đã tồn tại!';
        } else {
            $pass = md5($password);
            $sql = mysqli_query($connect, "INSERT INTO customer(customer_email, customer_fullname, customer_password, customer_phone, customer_address,created_at,updated_at) VALUES ('$email','$fullname','$pass','$phone','$address','$created_at','$updated_at')");
            header("location:login.php");

        }
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
    <title>Đăng kí</title>
</head>

<body>
    <div class="container">
        <div class="register">
            <h1><a href="../index.php"><i class="fa-solid fa-house-chimney"></i></a> Đăng kí</h1>
            <form action="" method="post">
                <div class="form-control">
                    <input type="email" name="email_name" required id="" placeholder="Email">
                    <span></span>
                    <div class="error">
                        <?php echo $error['username'] ?>
                    </div>
                </div>
                <div class="form-control">
                    <input type="text" name="fullname" required id="" placeholder="Họ và tên">
                    <span></span>
                    <div class="error"></div>
                </div>
                <div class="form-control">
                    <input class="password" type="password" name="password" required id="" placeholder="Mật khẩu">
                    <button type="button" class="showHide" onclick="showHidePass(0)"><i
                            class="fa-solid fa-eye-slash"></i></button>
                    <span></span>
                    <div></div>
                </div>
                <div class="form-control">
                    <input class="password" type="password" name="confirm_password" required id=""
                        placeholder="Confirm Password">
                    <button type="button" class="showHide" onclick="showHidePass(1)"><i
                            class="fa-solid fa-eye-slash"></i></button>
                    <span></span>
                    <div class="error">
                        <?php echo $error['confirm_password'] ?>
                    </div>
                </div>
                <div class="form-control">
                    <input type="text" name="phone" id="" required placeholder="Số điện thoại">
                    <span></span>
                    <div class="error">
                        <?php echo $error['phone'] ?>
                    </div>
                </div>
                <div class="form-control">
                    <input type="text" name="address" id="" required placeholder="Địa chỉ">
                    <span></span>
                    <div></div>
                </div>
                <button type="submit" name="register" class="btn-submit">Đăng kí</button>
            </form>
            <div class="link">
                Đã có tài khoản?<a href="./login.php"> Đăng nhập</a>
            </div>
        </div>
    </div>

    <script src="../js/showHidePassword.js"></script>
</body>

</html>
<?php
mysqli_close($connect);
?>