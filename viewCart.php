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


//xoa sp khoi gio hang


if (isset($_GET['idxoa'])) {
    $id = $_GET['idxoa'];
    unset($_SESSION['cart'][$id_customer][$id]);
}

$phong = mysqli_query($connect, "SELECT*FROM room");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/viewCart.css">
    <link rel="stylesheet" href="./index/css/footer.css">
</head>

<body>
    <?php
    require './php/header_nav.php'; // import header va nav vao trang chu
    ?>
    <div class="cart-overload">
        <?php if (isset($_SESSION['error']['overload']))
            echo $_SESSION['error']['overload'];
        unset($_SESSION['variable']); ?>
    </div>
    <div class="cart">
        <?php
        $thanh_tien = 0;
        if (!empty($_SESSION['cart'][$id_customer])) {
            $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'][$id_customer] : [];
            // print_r(empty($_SESSION['cart'][$id_customer]));
            $stt = 0;
            ?>
            <table>
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Tên sản phẩm</td>
                        <td>Hình ảnh</td>
                        <td>Số lượng</td>
                        <td>Đơn giá</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <!-- in san pham tu gio hang theo id khach hang -->
                    <?php
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
                            <td><img src="./Admin/img/imgProduct/<?php echo $value['image'] ?>"></td>
                            <td>
                                <a class="button-quantity" href="./php/cart.php?reduce=1&id=<?php echo $value['id'] ?>">-</a>
                                <?php echo $value['quantity'] ?>
                                <a class="button-quantity" href="./php/cart.php?id=<?php echo $value['id'] ?>">+</a>
                            </td>
                            <td>
                                <?php echo number_format($value['price'] * $value['quantity']) . 'đ' ?>
                            </td>
                            <td><a href="?idxoa=<?php echo $key ?>"
                                    style="background-color: red; color: white;padding: 6px; border-radius: 2px;">Xoá</a></td>
                        </tr>

                        <?php
                        //tính tổng tiền
                        $thanh_tien += $value['price'] * $value['quantity'];
                        ?>

                        <?php
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
            <?php
        } else {
            echo '<div class="empty-cart"><img src="./index/logo/cartEmpty.png"></div>';
        }
        ?>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <?php
        if ($thanh_tien == 0) {
        } else {
            ?>
            <a href="./viewOrder.php?idcustomer=<?php echo $id_customer ?>"
                style="background-color: brown;text-align: center;color: white; border-radius: 5px;padding: 12px 20px;">CheckOut</a>
            <?php
        }
        ?>
    </div>
    <?php
    require './php/footer.php'; // import header va nav vao trang chu
    ?>
</body>

</html>
<?php
mysqli_close($connect);
?>