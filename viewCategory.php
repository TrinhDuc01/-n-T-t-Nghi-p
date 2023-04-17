<?php
session_start();
require "connect.php";
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("location:index.php");
}

if (isset($_GET['id_category'])) {
    $id_category = $_GET['id_category'];
} else {
    header('location:index.php');
}

$sql = mysqli_query($connect, "SELECT * FROM product_category WHERE category_id = '$id_category'");
//lau ten danh muc
$laytendanhmuc = mysqli_fetch_array($sql);
$phong = mysqli_query($connect, "SELECT*FROM room");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $laytendanhmuc['category_name'] ?>
    </title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/content.css">
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
                <?php echo $laytendanhmuc['category_name'] ?>
            </span>
            <!-- <a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a> -->
        </div>
        <?php // phan trang
        $queryRows = mysqli_query($connect, "SELECT * FROM `product` Where category_id = '$id_category'");
        $totalRows = mysqli_num_rows($queryRows);
        $pageSize = 8; // số dòng tối đa trong 1 trang
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
        <div class="list">
            <ul>
                <?php
                $sanphamtheodanhmuc = mysqli_query($connect, "SELECT * FROM `product` Where category_id = '$id_category' limit {$rowStart} , {$pageSize}");
                while ($row = mysqli_fetch_array($sanphamtheodanhmuc)) {
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
                            <a class="themvao" href="./php/cart.php?id=<?php echo $row['product_id'] ?>">Thêm vào giỏ</a>
                            <a class="xemthem" href="./viewDetailProduct.php?id_product=<?php echo $row['product_id'] ?>">Xem
                                thêm</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>

        </div>

    </div>
    <div style="margin:0 0 50px 50px">
        Trang:
        <?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : 1 ?>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPage; $i++) {
                if ($pageCurrent == $i) {
                    echo "<a>" . $i . "</a>";
                } else {
                    ?>
                    <a href="?id_category=<?php echo $id_category ?>&page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
                    <?php
                }
            }
            ?>
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