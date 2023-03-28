<?php
session_start();
require "connect.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="./index/css/header.css">
	<link href="./icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="./index/css/nav.css">
	<link rel="stylesheet" href="./index/css/content.css">
	<link rel="stylesheet" href="./index/css/content.css">
</head>

<body>
	<header>
		<a href="index.php"><img src="./index/logo/logobinhminh.png"></a>
		<div class="search">
			<input type="text" placeholder="Tìm kiếm sản phẩm">
			<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
		</div>
		<a href="" class="account">
			<i class="fa-regular fa-user"></i>
			<p>Đăng nhập</p>
		</a>
		<a href="" class="cart">
			<i class="fa-solid fa-bag-shopping"></i>
			<p>Giỏ hàng</p>
		</a>
	</header>
	<nav>
		<ul>
			<li>
				<a href="#">Sản phsadasẩm <i class="fa-solid fa-chevron-down"></i></a>
				<ul>
					<li><a href="">dầgdfaggh </a>
						<ul>
							<li>
								<a href="">asdasdasdsads</a>
							</li>
							<li>
								<a href="">asdasdasdsads</a>
							</li>
							<li>
								<a href="">asdasdasdsads</a>
							</li>
							<li>
								<a href="">asdasdasdsads</a>
							</li>
						</ul>
					</li>
					<li><a href="">dầgdfaggh</a></li>
					<li><a href="">dầgdfaggh</a></li>
					<li><a href="">sadasdasaggh</a></li>
					<li><a href="">dầgdfaggh</a>
					</li>
				</ul>
			</li>
			<li><a href="">ádasdasd</a></li>
			<li><a href="">ádasdasd</a></li>
			<li><a href="">ádasdasd</a></li>
			<li><a href="">ádasdasd</a></li>
			<li><a href="">ádasdasd</a></li>
			<li><a href="">ádasdasd</a></li>
		</ul>
	</nav>
	<div class="content">
		<div class="product_list">
			<div class="product_list_title">
				<span>Sản phẩm mới</span>
				<a href="">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a>
			</div>
			<div class="list">
				<ul>
					<?php
					$newproduct = mysqli_query($connect, "SELECT * FROM `product` ORDER BY product_id DESC LIMIT 8");
					while ($row = mysqli_fetch_array($newproduct)) {
						?>
						<li>
							<img src="./admin/imgAdmin/<?php echo $row['product_image'] ?>" alt="Không có ảnh">
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
			</div>
		</div>
	</div>
</body>

</html>