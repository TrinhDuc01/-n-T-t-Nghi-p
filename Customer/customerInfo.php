<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
	$user = $_SESSION['login'];
} else {
	header('location:login.php');
}
$id = $user['customer_id'];

$layuser = mysqli_query($connect, "SELECT * FROM customer WHERE customer_id = '$id'");
$show = mysqli_fetch_array($layuser);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thông tin khách hàng</title>
	<link rel="stylesheet" type="text/css" href="./css/style_user.css">
	<link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
</head>

<body>
		<div class="header">
			<a href="../../index.php"><i class="fa-sharp fa-solid fa-house"></i> Xin Chào
				<?php echo $user['customer_fullname']; ?>
			</a>
		</div>
		<div class="container-f">
			<ul>
				<li><a href="./customerInfor.php">Thông tin</a></li>
				<li><a href="./viewOrder.php">Đơn hàng</a></li>
				<li><a href="./changePasswordUser.php">Đổi mật khẩu</a></li>
				<li><a href="./changeInfo.php">Đổi thông tin</a></li>
			</ul>
			<div class="view-info">
				<table>
					<tr>
						<td>Tên đăng nhập</td>
						<td>
							<?php echo $show['customer_email'] ?>
						</td>
					</tr>
					<tr>
						<td>Họ và tên</td>
						<td>
							<?php echo $show['customer_fullname'] ?>
						</td>
					</tr>
					<tr>
						<td>Số điện thoại</td>
						<td>
							<?php echo $show['customer_phone'] ?>
						</td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
						<td>
							<?php echo $show['customer_address'] ?>
						</td>
					</tr>
					<tr>
						<td>Ngày tạo</td>
						<td>
							<?php echo $show['created_at'] ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
</body>

</html>
<?php
mysqli_close($connect);
?>