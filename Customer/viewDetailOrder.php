<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header('location:login.php');
}

$id_user = $user['customer_id'];
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "SELECT 
  * From detail_order
  INNER JOIN product ON detail_order.product_id = product.product_id
  WHERE detail_order.order_id = '$order_id'";
    $donhang = mysqli_query($connect, $sql);

}

if (isset($_GET['huydon'])) {
    $huydon = $_GET['huydon'];
    mysqli_query($connect, "UPDATE order_p SET order_status= 4 WHERE customer_id='$id_user' AND order_id='$huydon' AND order_status=0");
    header('location:viewListOrder.php');
}
$layuser = mysqli_query($connect, "SELECT * FROM customer WHERE customer_id = '$id_user'");
$show = mysqli_fetch_array($layuser);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đặt hàng</title>

    <link rel="stylesheet" type="text/css" href="./css/style_user.css">
    <link rel="stylesheet" type="text/css" href="./css/detailOrder.css">
    <link rel="stylesheet" type="text/css" href="./css/table.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">

</head>

<body>
    <div class="header">
        <a href="../index.php"><i class="fa-sharp fa-solid fa-house"></i> Xin Chào
            <?php echo $show['customer_fullname']; ?>
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
            <div class="order_detail">
                <table>
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td>Hình ảnh</td>
                        <td>Đơn giá</td>
                        <td>Số lượng</td>
                        <td>Thành tiền</td>
                    </tr>
                    <?php
                    $tong_tien = 0;
                    while ($detail_order = mysqli_fetch_array($donhang)) {
                        $tong_tien += $detail_order['product_price'] * $detail_order['order_quantity'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $detail_order['product_name'] ?>
                            </td>
                            <td><img src="../Admin/img/imgProduct/<?php echo $detail_order['product_image'] ?>"></img></td>
                            <td>
                                <?php echo number_format($detail_order['product_price']) ?>
                            </td>
                            <td>
                                <?php echo $detail_order['order_quantity'] ?>
                            </td>
                            <td>
                                <?php echo number_format((int) $detail_order['order_quantity'] * (int) $detail_order['product_price']) ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan=4>Tổng tiền</td>
                        <td>
                            <?php echo number_format($tong_tien) . ' đ' ?>
                        </td>
                    </tr>
                </table>
                <?php
                $dieukien = mysqli_query($connect, "SELECT * from order_p WHERE customer_id='$id_user' AND order_id='$order_id' AND order_status=0");
                $row = mysqli_num_rows($dieukien);
                if ($row != 0) {
                    ?>
                    <a href="?huydon=<?php echo $order_id ?>" onclick="if(confirmM()==0)return false;" class="NO">Huỷ
                        đơn</a>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>
<script>
    let confirmM = () => {
        let choose = confirm("Bạn có muốn huỷ đơn?");
        if (choose == true) {
            return 1;
        }
        else
            return 0;
    }
</script>
<?php
mysqli_close($connect);
?>