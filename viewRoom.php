<?php
session_start();
require "connect.php";
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("location:index.php");
}

if (isset($_GET['roomid'])) {
    $idroom = $_GET['roomid'];
} else {
    header('location:index.php');
}

$sql = mysqli_query($connect, "SELECT*FROM room where room_id = '$idroom'");



$laytenphong = mysqli_fetch_array($sql);

$phong = mysqli_query($connect, "SELECT*FROM room");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $laytenphong['room_name'] ?>
    </title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/room.css">
    <link rel="stylesheet" href="./index/css/footer.css">
    <link rel="stylesheet" href="./Admin/css/pagination.css">
</head>

<body>
    <?php
    require './php/header_nav.php'; // import header va nav vao trang chu
    ?>
    <div class="product_list">
        <div class="product_list_title">
            <span>
                <?php echo $laytenphong['room_name'] ?>
            </span>
            <!-- <a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a> -->
        </div>

        <?php // phan trang
        $queryRows = mysqli_query($connect, "SELECT * FROM product_category inner join room on product_category.room_id = room.room_id inner join product on product_category.category_id = product.category_id Where room.room_id = '$idroom'");
        $totalRows = mysqli_num_rows($queryRows);
        $pageSize = 9; // số dòng tối đa trong 1 trang
        $totalPage = 1; // tính  tổng số trang
        
        // print_r($tencot);
        
        if ($totalRows % $pageSize == 0) {
            $totalPage = $totalRows / $pageSize;
        } else {
            $totalPage = (int) ($totalRows / $pageSize) + 1;
        }
        $rowStart = 1;
        $pageCurrent = 1;

        if ((!isset($_GET['page'])) || ($_GET['page'] == 1)) {
            $rowStart = 0;
            $pageCurrent = 1;
        } else {
            $rowStart = ($_GET['page'] - 1) * $pageSize;
            $pageCurrent = $_GET['page'];
        }

        ?>

        <div class="container">
            <div class="categorylist">
                <ul>
                    <?php
                    $sql1 = mysqli_query($connect, "SELECT*FROM product_category where room_id = '$idroom'");
                    while ($row = mysqli_fetch_array($sql1)) {
                        ?>
                        <li> <a href="./viewCategory.php?idcategory=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a> </li>
                        <?php
                    }

                    ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php
                    $sqlRoom = "SELECT * FROM product_category inner join room on product_category.room_id = room.room_id inner join product on product_category.category_id = product.category_id Where room.room_id = '$idroom' limit {$rowStart} , {$pageSize}";
                    $productinroom = mysqli_query($connect, $sqlRoom);
                    while ($row = mysqli_fetch_array($productinroom)) {
                        ?>
                        <li>
                            <img src="./admin/img/imgProduct/<?php echo $row['product_image'] ?>" alt="Không có ảnh">
                            <div class="product_title">
                                <?php echo $row['product_name'] ?>
                            </div>
                            <span><i class="fa-regular fa-heart"></i></span>
                            <span class="product_price">
                                <?php $price = number_format($row['product_price']);
                                echo $price . 'đ'; ?>
                            </span><br>
                            <div class="chucnang">
                                <a class="themvao" href="cart.php?id=<?php echo $row['product_id'] ?>">Thêm vào giỏ</a>
                                <a class="xemthem"
                                    href="./viewdetailproduct.php?idproduct=<?php echo $row['product_id'] ?>">Xem thêm</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($pageCurrent == $i) {
                            echo "<a>" . $i . "</a>";
                        } else {
                            ?>
                            <a href="?page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    require './php/footer.php'; // import header va nav vao trang chu
    ?>
</body>

</html>
<?php
mysqli_close($connect);
?>