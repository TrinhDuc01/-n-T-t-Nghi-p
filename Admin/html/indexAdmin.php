<?php
session_start();
require "../../connect.php";
if(isset($_SESSION['admin_login'])){
	
}
else{
	header("location:LoginAdmin.php");
}
if(isset($_POST['logout'])){
	unset($_SESSION['admin_login']);
	header("location:LoginAdmin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang chủ Admin</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageProduct/CreateReadDeleteProduct.php">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageCategory/CreateReadDeleteCategory.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageRoom/CreateReadDeleteRoom.php">Quản lý phòng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageMaterial/CreateReadDeleteMaterial.php">Quản lý vật liệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageCustomer/ReadCustomer.php">Quản lý khách hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Manage/ManageOrder/ReadOrder.php">Quản lý đơn hàng</a>
        </li>
        
      </ul>
      <form class="d-flex" method="post">
        <input class="btn btn-danger" type="submit" name="logout" value="Log Out">
      </form>
    </div>
  </div>
</nav>
<div></div>
<div>
	
</div>

<script type="text/javascript" src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>
<?php
mysqli_close($connect);
?>