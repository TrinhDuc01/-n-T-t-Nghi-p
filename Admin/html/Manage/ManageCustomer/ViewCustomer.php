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

if (isset($_GET['id'])) {
  $id = $_GET['id'];
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
        <tr class="text-center">
          <th scope="col">Mã đơn hàng</th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Giá</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Thành tiền</th>
          <th scope="col">Tên khách hàng</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Ngày đặt</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT order_id,product_name,product_price,order_p.order_quantity,customer_fullname,order_status,order_status_customer,order_p.created_at 
        FROM order_p inner join product on order_p.product_id=product.product_id 
        inner join customer on order_p.customer_id = customer.customer_id WHERE order_p.customer_id='$id'
        ORDER BY order_p.order_id DESC";
        $donhang = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($donhang)) {
          ?>

          <tr class="text-center" style="<?php echo $row['order_status_customer'] == 0 ? 'opacity:0.5;' : '' ?>">
            <td>
              <?php echo $row['order_id'] ?>
            </td>
            <td>
              <?php echo $row['product_name'] ?>
            </td>
            <td>
              <?php echo number_format($row['product_price']) . 'đ' ?>
            </td>
            <td>
              <?php echo $row['order_quantity'] ?>
            </td>
            <td>
              <?php echo number_format($row['order_quantity'] * $row['product_price']) . 'đ' ?>
            </td>
            <td>
              <?php echo $row['customer_fullname'] ?>
            </td>
            <td>
              <?php echo $row['order_status'] == 0 ? '<button type="" name="add_product" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Chưa duyệt</button>' : '<button type="" name="add_product" class="btn btn-success"><i class="fa-solid fa-check"></i> Đã duyệt</button>' ?>
            </td>
            <td>
              <?php echo $row['created_at'] ?>
            </td>
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