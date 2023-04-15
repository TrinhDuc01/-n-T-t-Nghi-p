<?php
session_start();
require "../connect.php";
$error['username'] = '';
$error['confirm_password'] = '';

//chuc nang dang ky
if(isset($_POST['register'])){
	$username = $_POST['username'];
    $fullname = $_POST['fullname'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = NULL;

	$rows = mysqli_query($connect,"SELECT * FROM customer WHERE customer_name = '$username'");
	$count = mysqli_num_rows($rows);
    if($password != $confirm_password){
        $error['confirm_password'] = 'Mật khẩu xác nhận không chính xác!';
    }
    else{
        if($count==1){
            $error['username'] = 'Tên tài khoản đã tồn tại!';
        }
        else{
            $pass = md5($password);
            $sql = mysqli_query($connect,"INSERT INTO customer(customer_name, customer_fullname, customer_password, customer_phone, customer_address,created_at,updated_at) VALUES ('$username','$fullname','$pass','$phone','$address','$created_at','$updated_at')");
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
    <link rel="stylesheet" href="./css/style_login.css">
    <title>Đăng kí</title>
</head>
<body>
    <div class="container">
    <div class="register">
            <h1>Đăng kí</h1>
            <form action="" method="post">
            <div class="form-control">
                <input type="email" name="username" required id="" placeholder="Email">
                <span></span>
                <div class="error"><?php echo $error['username']?></div>
            </div>
            <div class="form-control">
                <input type="text" name="fullname" required id="" placeholder="Họ và tên">
                <span></span>
                <div class="error"></div>
            </div>
            <div class="form-control">
                <input type="password" name="password" required id="" placeholder="Mật khẩu">
                <span></span>
                <div></div>
            </div>
            <div class="form-control">
                <input type="password" name="confirm_password" required id="" placeholder="Confirm Password">
                <span></span>
                <div class="error"><?php echo $error['confirm_password']?></div>
            </div>
            <div class="form-control">
                <input type="text" name="phone" id="" required placeholder="Số điện thoại">
                <span></span>
                <div></div>
            </div>
            <div class="form-control">
                <input type="text" name="address" id="" required placeholder="Địa chỉ">
                <span></span>
                <div></div>
            </div>
            <button type="submit" name="register" class="btn-submit">Đăng kí</button>
            </form>
            <div class="link">
            <a href="./login.php">Đăng nhập</a>
            </div>
        </div>
    </div>

    <script src="../js/login.js"></script>
</body>
</html>
<?php
mysqli_close($connect);
?>