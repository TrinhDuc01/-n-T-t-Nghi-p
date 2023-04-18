<?php
session_start();
require "connect.php";
if (isset($_GET['logout'])) {
	unset($_SESSION['login']);
	header("location:index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="./index/css/header.css">
	<link href="./icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="./index/css/nav.css">
	<link rel="stylesheet" href="./index/css/content.css">
	<link rel="stylesheet" href="./Admin/css/pagination.css">
	<link rel="stylesheet" href="./index/css/footer.css">
</head>

<body>
	<?php
	require './php/header_nav.php'; // import header va nav vao trang chu
	?>
	<div class="content">
		<div class="product_list">
			<div class="product_list_title">
				<span>Sản phẩm mới</span>
				<a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a>
			</div>
			<?php // phan trang
			$queryRows = mysqli_query($connect, "SELECT * FROM `product`");
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

			?>
			<div class="list">
				<ul>
					<?php
					$newproduct = mysqli_query($connect, "SELECT * FROM `product` ORDER BY product_id DESC LIMIT {$rowStart} , {$pageSize}");
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
						<a href="?page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>

</body>
<?php
require './php/footer.php'; // import header va nav vao trang chu
?>

</html>