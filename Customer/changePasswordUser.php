<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header('location:login.php');
}
$error['cp'] = '';
$error['op'] = '';
$success = '';

$id = $user['customer_id'];

if (isset($_POST['changepass'])) {
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];
    $pass1 = md5($newpass);
    $pass2 = md5($oldpass);
    $updated_at = date('Y-m-d H:i:s');
    $sql = mysqli_query($connect, "SELECT * FROM customer WHERE customer_password = '$pass2'");
    $row = mysqli_num_rows($sql);
    if ($row == 1) {
        if ($confirmpass != $newpass) {
            $error['cp'] = 'Mật khẩu xác nhận không chính xác';
        } else {
            $doimatkhau = mysqli_query($connect, "UPDATE customer SET customer_password = '$pass1',updated_at='$updated_at' WHERE customer_id = '$id'");
            $success = 'Đổi mật khẩu thành công';
        }
    } else {
        $error['op'] = 'Mật khẩu cũ không chính xác';
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" type="text/css" href="./css/style_user.css">
    <link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="header">
        <a href="../index.php"><i class="fa-sharp fa-solid fa-house"></i> Xin Chào
            <?php echo $user['customer_fullname']; ?>
        </a>
    </div>
    <div class="container-f">
        <ul>
            <li><a href="./customerInfo.php">Thông tin</a></li>
            <li><a href="./viewListOrder.php">Đơn hàng</a></li>
            <li><a href="./changePasswordUser.php">Đổi mật khẩu</a></li>
            <li><a href="./changeInfo.php">Đổi thông tin</a></li>
        </ul>
        <div class="view-info">
            <form method="post">
                <div style="color: red; text-align: center;">
                    <?php echo $error['op'] . '. ' . $error['cp']; ?>
                </div>
                <div style="color: #18cb4e; text-align: center;">
                    <?php echo $success ?>
                </div>
                <table>
                    <tr>
                        <td>Mật khẩu cũ</td>
                        <td><input class="password" required type="password" name="oldpass" id=""><button type="button" class="showHide" onclick="showHidePass(0)"><i
                                    class="fa-solid fa-eye-slash"></i></button>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Mật khẩu mới</td>
                        <td><input class="password" required type="password" name="newpass" id=""><button type="button" class="showHide"
                                onclick="showHidePass(1)"><i class="fa-solid fa-eye-slash"></i></button></td>
                    </tr>
                    <tr>
                        <td>Xác nhận mật khẩu mới</td>
                        <td><input class="password" required type="password" name="confirmpass" id=""><button type="button"
                                class="showHide" onclick="showHidePass(2)"><i class="fa-solid fa-eye-slash"></i></button>
                        </td>
                    </tr>
                    <tr class="btn">
                        <td colspan="2">
                            <button class="success" type="submit" name="changepass">Đổi mật khẩu</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
<script src="../js/showHidePassword.js"></script>

</html>
<?php
mysqli_close($connect);
?>