<?php
session_start();
require "connect.php";
error_reporting(0);
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("location:index.php");
}
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="./index/css/header.css">
    <link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./index/css/nav.css">
    <link rel="stylesheet" href="./index/css/content.css">
    <link rel="stylesheet" href="./Admin/css/pagination.css">
    <link rel="stylesheet" href="./index/css/footer.css">
    <link rel="stylesheet" href="./index/css/search.css">
</head>

<body>
    <?php
    require './php/header_nav.php'; // import header va nav vao trang chu
    ?>
    <div class="content">
        <div class="product_list">
            <div class="product_list_title">
                <span>Hiển thị kết quả tìm kiếm cho từ khoá:
                    <?php echo $keyword ?>
                </span>
                <!-- <a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a> -->
            </div>
            <?php // phan trang
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $keyword)) {
                ?>
                <div class="search-empty">
                    <img src="./index/logo/empty-result.png" alt="" srcset="">
                    <h3>Không tìm thấy sản phẩm</h3>
                    <p>Vui lòng kiểm tra chính tả hoặc sử dụng từ khóa khác.</p>
                </div>
                <?php
            } else {
                $queryRows = mysqli_query($connect, "SELECT * FROM product 
            INNER JOIN product_category ON product.category_id = product_category.category_id 
            INNER JOIN material ON product.material_id = material.material_id 
            INNER JOIN room ON product_category.room_id = room.room_id
            WHERE product_name LIKE '%$keyword%' OR category_name LIKE '%$keyword%'  OR room_name LIKE '%$keyword%' OR material_name LIKE '%$keyword%'");
                $totalRows = mysqli_num_rows($queryRows);
                $pageSize = 12; // số dòng tối đa trong 1 trang
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
                if ($totalRows == 0) {
                    ?>
                    <div class="search-empty">
                        <img src="./index/logo/empty-result.png" alt="" srcset="">
                        <h3>Không tìm thấy sản phẩm</h3>
                        <p>Vui lòng kiểm tra chính tả hoặc sử dụng từ khóa khác.</p>
                    </div>
                    <?php
                } else {
                    ?>

                    <div class="list">
                        <ul>
                            <?php
                            $newproduct = mysqli_query($connect, "SELECT * FROM product 
                    INNER JOIN product_category ON product.category_id = product_category.category_id 
                    INNER JOIN material ON product.material_id = material.material_id 
                    INNER JOIN room ON product_category.room_id = room.room_id 
                    WHERE product_name LIKE '%$keyword%' OR category_name LIKE '%$keyword%'  OR room_name LIKE '%$keyword%' OR material_name LIKE '%$keyword%'
                    ORDER BY product_id  DESC LIMIT {$rowStart} , {$pageSize}");
                            while ($row = mysqli_fetch_array($newproduct)) {
                                ?>
                                <li>
                                    <img src="./Admin/img/imgProduct/<?php echo $row['product_image'] ?>" alt="Không có ảnh">
                                    <div class="product_title">
                                        <?php echo $row['product_name'] ?>
                                    </div>
                                    <span><i class="fa-regular fa-heart"></i></span>
                                    <span class="product_price">
                                        <?php $price = number_format((float) $row['product_price']);
                                        echo $price . 'đ'; ?>
                                    </span><br>
                                    <div class="chucnang">
                                        <a class="themvao" href="./php/cart.php?id=<?php echo $row['product_id'] ?>">Thêm vào
                                            giỏ</a>
                                        <a class="xemthem"
                                            href="./viewDetailProduct.php?id_product=<?php echo $row['product_id'] ?>">Xem thêm</a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    Trang:
                    <?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : 1 ?>
                    <div class="pagination">
                        <?php
                        for ($i = 1; $i <= $totalPage; $i++) {
                            if ($pageCurrent == $i) {
                                echo "<a>" . $i . "</a>";
                            } else {
                                ?>
                                <a href="?keyword=<?php echo $keyword ?>&page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
                                <?php
                            }
                        }
                }
            }
            ?>
            </div>
        </div>
    </div>
    <?php
    require './php/footer.php'; // import header va nav vao trang chu
    ?>
</body>

</html>