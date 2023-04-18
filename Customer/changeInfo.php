<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header('location:login.php');
}

$id = $user['customer_id'];

$layuser = mysqli_query($connect, "SELECT * FROM customer WHERE customer_id = '$id'");
$show = mysqli_fetch_array($layuser);
$success = '';
if (isset($_POST['changeinfo'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $updated_at = date('Y-m-d H:i:s');
    $sql = "UPDATE customer SET customer_fullname = '$fullname', customer_phone = '$phone', customer_address = '$address', updated_at = '$updated_at' WHERE customer_id = '$id'";
    $query = mysqli_query($connect, $sql);
    $success = 'Thay đổi thông tin thành công';
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi thông tin</title>
    <link rel="stylesheet" type="text/css" href="./css/style_user.css">
    <link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="header">
        <a href="../../index.php"><i class="fa-sharp fa-solid fa-house"></i> Xin Chào
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
                <div style="color: #18cb4e; text-align: center;">
                    <?php echo $success ?>
                </div>
                <table>
                    <tr>
                        <td>Họ và tên</td>
                        <td> <input type="text" name="fullname" required
                                value="<?php echo $show['customer_fullname'] ?>" id=""> </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td> <input type="text" name="phone" required value="<?php echo $show['customer_phone'] ?>"
                                id=""> </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td> <input type="text" name="address" required value="<?php echo $show['customer_address'] ?>"
                                id=""></td>
                    </tr>
                    <tr class="btn">
                        <td colspan="2">
                            <button class="success" type="submit" name="changeinfo">Đổi thông tin</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($connect);
?>