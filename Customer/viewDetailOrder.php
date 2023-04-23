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
  order_id,product_name,customer_phone,receiver_name,receiver_phonenumber,receiver_address,product_price,order_p.order_quantity,product_image,order_status_customer,order_p.created_at,order_p.updated_at
  FROM order_p inner join product on order_p.product_id=product.product_id 
  inner join customer on order_p.customer_id = customer.customer_id 
  WHERE order_id = '$order_id'";
    $donhang = mysqli_query($connect, $sql);
    $detail_order = mysqli_fetch_array($donhang);
}

if (isset($_GET['huydon'])) {
    $huydon = $_GET['huydon'];
    mysqli_query($connect, "UPDATE order_p SET order_status_customer = 0 WHERE customer_id='$id_user' AND order_id='$huydon'");
    header('location:ViewOrder.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đặt hàng</title>

    <link rel="stylesheet" type="text/css" href="./css/style_user.css">
    <link rel="stylesheet" type="text/css" href="./css/detailOrder.css">
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
            <li><a href="./customerInfor.php">Thông tin</a></li>
            <li><a href="./viewListOrder.php">Đơn hàng</a></li>
            <li><a href="./changePasswordUser.php">Đổi mật khẩu</a></li>
            <li><a href="./changeInfo.php">Đổi thông tin</a></li>
        </ul>
        <div class="view-info">
            <div class="order_detail">
                <h2>Thông tin đơn hàng</h2>
                <h2>Mã đơn:
                    <?php echo $detail_order['order_id'] ?>
                </h2>
                <h4>Họ và tên người nhận:
                    <?php echo $detail_order['receiver_name'] ?>
                </h4>
                <h4>Số điện thoại người nhận:
                    <?php echo $detail_order['receiver_phonenumber'] ?>
                </h4>
                <h4>Địa chỉ người nhận:
                    <?php echo $detail_order['receiver_address'] ?>
                </h4>
                <h4>Tên sản phẩm:
                    <?php echo $detail_order['product_name'] ?>
                </h4>
                <h4>Số lượng:
                    <?php echo $detail_order['order_quantity'] ?>
                </h4>
                <h4>Đơn giá:
                    <?php echo number_format($detail_order['product_price']) . 'đ' ?>
                </h4>
                <h4>Thành tiền:
                    <?php echo number_format($detail_order['product_price'] * $detail_order['order_quantity']) . 'đ' ?>
                </h4>
                <h4>Tạo lúc:
                    <?php echo $detail_order['created_at'] ?>
                </h4>
                <h4>Cập nhật lúc:
                    <?php echo $detail_order['updated_at'] ?>
                </h4>
                <a href="?huydon=<?php echo $order_id ?>" onclick="if(confirmM()==0)return false;" class="NO">Huỷ
                    đơn</a>
            </div>
            <div class="image">
                <h4>Hình ảnh: </h4><img src="../Admin/img/imgProduct/<?php echo $detail_order['product_image'] ?>"
                    alt="">
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