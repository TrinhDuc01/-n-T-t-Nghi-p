<?php
session_start();
require "../../../connect.php";
if (isset($_SESSION['loged'])) {

} else {
  header("location:../../LoginAdmin.php");
}
if (isset($_POST['logout'])) {
  unset($_SESSION['loged']);
  header("location:../../LoginAdmin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ Admin</title>
  <link rel="stylesheet" type="text/css" href="../../../bootstrap-5.0.2-dist/css/bootstrap.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageProduct/CreateReadDeleteProduct.php">Quản lý
              sản phẩm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageCategory/CreateReadDeleteCategory.php">Quản lý
              danh mục</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageRoom/CreateReadDeleteRoom.php">Quản lý
              phòng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageMaterial/CreateReadDeleteMaterial.php">Quản lý
              vật liệu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageCustomer/ReadCustomer.php">Quản lý khách
              hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../ManageOrder/ReadOrder.php">Quản lý đơn hàng</a>
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
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Họ và tên</th>
          <th scope="col">Số điện thoại</th>
          <th scope="col">Địa chỉ</th>
          <th scope="col">Thông tin đặt hàng</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sqlkh = mysqli_query($connect, "SELECT * FROM customer");
        $stt = 0;
        while ($row = mysqli_fetch_array($sqlkh)) {
          $stt++;
          ?>
          <tr>
            <th><?php echo $stt ?></th>
            <td><?php echo $row['customer_name'] ?></td>
            <td><?php echo $row['customer_phone'] ?></td>
            <td><?php echo $row['customer_address'] ?></td>
            <td><a style="background-color: lightblue;color: black; text-decoration:none; border-radius:5px; padding: 5px 10px;" href="./ViewCustomer.php?id=<?php echo $row['customer_id'] ?>">Xem chi tiết</a></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>

</html>

<?php
mysqli_close($connect);
?>