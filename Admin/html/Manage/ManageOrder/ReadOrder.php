<?php
session_start();
require "../../../../connect.php";
if (isset($_SESSION['admin_login'])) {

} else {
  header("location:../../LoginAdmin.php");
}
if (isset($_POST['logout'])) {
  unset($_SESSION['admin_login']);
  header("location:../../LoginAdmin.php");
}

if (isset($_GET['duyet_id'])) {
  $duyet_id = $_GET['duyet_id'];
  mysqli_query($connect, "UPDATE order_p SET order_status=1 WHERE order_id='$duyet_id' AND order_status=0 AND order_status_customer=1");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý đơn hàng</title>
  <link href="../../../../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
  <link rel="stylesheet" href="../../../css/table.css">
  <link rel="stylesheet" href="../../../css/pagination.css">
  <link rel="stylesheet" href="order.css">
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
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
          <th scope="col">Duyệt</th>
          <th scope="col">Chi tiết</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT *FROM order_p inner join product on order_p.product_id=product.product_id 
        inner join customer on order_p.customer_id = customer.customer_id ORDER BY order_p.order_id DESC";
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
              <a href="?<?php echo 'duyet_id=' . $row['order_id']; ?>" class="btn btn-primary">
                <i class="fa-solid fa-check"></i>
              </a>
            </td>
            <td>
              <a href="./DetailOrder.php?<?php echo 'order_id=' . $row['order_id']; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i>
              </a>
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