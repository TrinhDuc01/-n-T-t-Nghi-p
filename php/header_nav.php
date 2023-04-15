<header>
	<a href="index.php"><img src="./index/logo/logobinhminh.png"></a>
	<div class="search">
		<input type="text" placeholder="Tìm kiếm sản phẩm">
		<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
	</div>
	<?php
	if (isset($_SESSION['login'])) {
		echo '<a class="account" href="./Customer/infoUser.php">' . '<i class="fa-solid fa-user"></i>' . $_SESSION['login']['customer_fullname'] . '</a>' .
			'<a style="color: red" href="?logout=123" type="submit">Đăng xuất</a>';
		;
	} else {
		echo '<a href="./Customer/login.php">Đăng nhập <i class="fa-solid fa-user"></i></a>';
	}
	?>
</header>
<nav>
	<ul>
		<?php
		$phong = mysqli_query($connect, "SELECT*FROM room");
		while ($row = mysqli_fetch_array($phong)) {
			?>
			<li>
				<a href="./viewroom.php?roomid=<?php echo $row['room_id'] ?>">
					<?php echo $row['room_name'] ?> <i class="fa-solid fa-chevron-down"></i>
				</a>
				<ul>
					<?php
					$id = $row['room_id'];
					$danhmuc = mysqli_query($connect, "SELECT*FROM product_category WHERE room_id = '$id'");
					while ($indanhmuc = mysqli_fetch_array($danhmuc)) {
						?>
						<li><a href="./viewcategory.php?idcategory=<?php echo $indanhmuc['category_id'] ?>">
								<?php echo $indanhmuc['category_name'] ?>
							</a></li>
						<?php
					}
					?>
				</ul>
			</li>

			<?php
		}
		?>
		<li>
			<a href="" class="cart">
				Giỏ hàng <i class="fa-solid fa-bag-shopping"></i>
			</a>
		</li>
	</ul>
</nav>