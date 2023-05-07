<?php
session_start();
require "connect.php";
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("location:index.php");
}
if (!isset($_SESSION['login'])) {
    header('location:index.php');
}


$id_customer = $_SESSION['login']['customer_id'];
// $customer = mysqli_query($connect, "SELECT*FROM customer where customer_id = '$id_customer'");
// $infoUser = mysqli_fetch_array($customer);

//xoa sp khoi gio hang


if (isset($_GET['idxoa'])) {
    $id = $_GET['idxoa'];
    unset($_SESSION['cart'][$id_customer][$id]);
}
if (!isset($_SESSION['cart'][$id_customer])) {
    header('location:index.php');
}

$phong = mysqli_query($connect, "SELECT*FROM room");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/footer.css">
    <link rel="stylesheet" href="./index/css/order.css">
</head>

<body>
    <?php
    require './php/header_nav.php'; // import header va nav vao trang chu
    ?>
    <div style="text-align: center; font-size: 30px;font-weight: 700; margin-top: 40px;">Thông tin đặt hàng</div>
    <div class="order-container">
        <div class="InFor">
            <form action="./order.php" method="post">
                <table>
                    <tr>
                        <td colspan=2>Thông tin người nhận</td>
                    </tr>
                    <tr>
                        <td>Họ và tên</td>
                        <td><input required name="fullname" type="text"></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td><input id="phone_number" onchange="isNumberic()" required name="phone_number" type="text">
                            <div id="num_error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td><input required name="address" type="text"></td>
                    </tr>
                    <tr>
                        <td>Hình thức thanh toán</td>
                        <td>
                            <select>
                                <option value="1">Thanh toán trực tiếp</option>
                                <option value="2" disabled="disabled">Thanh toán qua thẻ ngân hàng</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="submit" name="order" class="order" value="Đặt hàng">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên sản phẩm</td>
                    <td>Hình ảnh</td>
                    <td>Số lượng</td>
                    <td>Đơn giá</td>
                </tr>
            </thead>
            <tbody>
                <!-- in san pham tu gio hang theo id khach hang -->
                <?php
                $thanh_tien = 0;
                if (isset($_SESSION['cart'][$id_customer])) {
                    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'][$id_customer] : [];
                    $stt = 0;

                    // echo '<pre>';
                    // print_r($cart);
                    foreach ($cart as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php echo ++$stt ?>
                            </td>
                            <td>
                                <?php echo $value['name'] ?>
                            </td>
                            <td><img src="./admin/img/imgProduct/<?php echo $value['image'] ?>"></td>
                            <td>
                                <?php echo $value['quantity'] ?>
                            </td>
                            <td>
                                <?php echo number_format($value['price'] * $value['quantity']) . 'đ' ?>
                            </td>
                        </tr>

                        <?php
                        //tính tổng tiền
                        $thanh_tien += $value['price'] * $value['quantity'];
                        ?>

                        <?php
                    }
                }
                ?>
                <tr>
                    <td colspan="4">Thành tiền</td>
                    <td>
                        <?php echo number_format($thanh_tien) ?>đ
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
    <?php
    require "./php/footer.php"
        ?>
</body>

</html>
<?php
mysqli_close($connect);
?>

<script>
    function isNumberic() {
        const checknum = document.getElementById('phone_number');
        const num_error = document.getElementById('num_error');
        const order = document.getElementsByClassName('order')[0];
        console.log(checknum);
        if(isNaN(checknum.value)){
            num_error.innerText = "Mời bạn nhập số";
            order.setAttribute('disabled','')
            console.log(order);
        }
        else{
            num_error.innerText = "";
            order.removeAttribute('disabled')
        }
    }
</script>