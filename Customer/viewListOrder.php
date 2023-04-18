<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header('location:login.php');
}

$id_user = $user['customer_id'];
// print_r($id_user);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đặt hàng</title>
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

            <table>
                <tr>
                    <td>Mã đơn hàng</td>
                    <td>Tên sản phẩm</td>
                    <td>Giá</td>
                    <td>Số lượng</td>
                    <td>Thành tiền</td>
                    <td>Trạng thái</td>
                    <td>Ngày đặt</td>
                    <td>Xem chi tiết</td>
                </tr>
                <?php
                $sql = "SELECT order_id,product_name,product_price,order_p.order_quantity,customer_fullname,order_status,order_status_customer,order_p.created_at 
FROM order_p inner join product on order_p.product_id=product.product_id 
inner join customer on order_p.customer_id = customer.customer_id WHERE order_p.customer_id='$id_user' ORDER BY order_id DESC";
                $donhang = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($donhang)) {
                    ?>

                    <tr style="<?php echo $row['order_status_customer'] == 0 ? 'opacity:0.5;' : '' ?>">
                        <td>
                            <?php echo $row['order_id'] ?>
                        </td>
                        <td>
                            <?php echo $row['product_name'] ?>
                        </td>
                        <td>
                            <?php echo number_format($row['product_price']) . 'đ' ?>
                        </td>
                        <td>
                            <?php echo $row['order_quantity'] ?>
                        </td>
                        <td>
                            <?php echo number_format($row['order_quantity'] * $row['product_price']) . 'đ' ?>
                        </td>

                        <td>
                            <?php echo $row['order_status'] == 0 ? '<button class="NO">Chưa duyệt</button>' : '<button class="YES">Đã duyệt</button>' ?>
                        </td>
                        <td>
                            <?php echo $row['created_at'] ?>
                        </td>
                        <td>
                            <a href="./ViewDetailOrder.php?<?php echo 'order_id=' . $row['order_id']; ?>" class="detail">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($connect);
?>