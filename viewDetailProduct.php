<?php
session_start();
require "connect.php";
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("location:index.php");
}

if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
    $check = mysqli_query($connect, "SELECT * FROM product inner join product_category on product.category_id = product_category.category_id inner join room on product_category.room_id = room.room_id inner join material on material.material_id = product.material_id Where product_id = '$id_product'");
    $row = mysqli_num_rows($check);
    if ($row == 0) {
        header('location:index.php');
    } else
        $show1sp = mysqli_fetch_array($check);
} else {
    header('location:index.php');
}

$phong = mysqli_query($connect, "SELECT*FROM room");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết</title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/room.css">
    <link rel="stylesheet" href="./index/css/footer.css">
    <link rel="stylesheet" href="./Admin/css/pagination.css">
    <link rel="stylesheet" href="./index/css/detailProduct.css">
</head>

<body>
<?php
    require './php/header_nav.php'; // import header va nav vao trang chu
    ?>
    <div class="product_list_title" style="margin-top:50px">
        <span>Chi tiết sản phẩm</span>
        <!-- <a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a> -->
    </div>
    <div class="container-product">
        <div class="container-img">
            <div class="slider-wrapper">
                <div class="slider">
                    <?php
                    //select ảnh mô tả
                    $show_d_img = mysqli_query($connect, "SELECT * FROM product_image_desc Where product_id = '$id_product'");
                    $keyFirst = 0;
                    while ($show_decription_img = mysqli_fetch_array($show_d_img)) {
                        $keyFirst += 1;
                        ?>
                        <img id="slider-<?php echo $keyFirst ?>"
                            src="./admin/img/imgProduct/<?php echo $show_decription_img['image_url'] ?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="slider-nav">
                <?php
                for ($i = 1; $i <= $keyFirst; $i++) {
                    ?>
                    <a href="#slider-<?php echo $i ?>"></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="info-product">
            <h3>
                <?php echo $show1sp['product_name'] ?>
            </h3>
            <div class="line"></div>
            <div class="price">
                <?php echo number_format($show1sp['product_price']) . 'đ' ?>
            </div>
            <div class="size">Kích thước:
                <span>
                    <?php echo $show1sp['product_size'] ?>
                </span>
            </div>
            <div class="material">Chất liệu:<span>
                    <?php echo $show1sp['material_name'] ?>
                </span></div>
            <div class="category">Danh mục:
                <span>
                    <?php echo $show1sp['category_name'] ?>
                </span>
            </div>
            <div class="category">Số lượng:
                <span>
                    <?php echo $show1sp['product_quantity'] ?>
                </span>
            </div>
            <div class="themvaogiohang">
                <?php
                if ($show1sp['product_quantity'] == 0) {
                    ?>
                    <a style="cursor: not-allowed; opacity: 0.5;"
                        href="./php/cart.php?id=<?php echo $show1sp['product_id'] ?>">Thêm vào giỏ hàng</a>
                    <?php
                } else {
                    ?>
                    <a href="./php/cart.php?id=<?php echo $show1sp['product_id'] ?>">Thêm vào giỏ hàng</a>
                    <?php
                }
                ?>

            </div>
            <div class="product_list_title" style="margin: 50px 0 10px 0; width:100%;">
                <div>Mô tả sản phẩm</div>

                <!-- <a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a> -->
            </div>
            <p>
                <?php echo $show1sp['product_description'] ?>
            </p>
        </div>
    </div>
    <?php
        require "./php/footer.php"
    ?>
</body>

</html>
<?php
mysqli_close($connect);
?>