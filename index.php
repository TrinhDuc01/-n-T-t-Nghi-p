<?php
session_start();
require "connect.php";
$phong = mysqli_query($connect, "SELECT*FROM room");
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
					<li><a href="">dầgdfaggh  </a>
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
</body>

</html>