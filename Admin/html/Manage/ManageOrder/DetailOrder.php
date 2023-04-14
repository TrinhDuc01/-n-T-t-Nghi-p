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
//lay don hang theo id
if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  $sql = "SELECT 
    order_id,product_name,customer_phone,customer_fullname,customer_address,product_price,order_p.order_quantity,product_image,order_status_customer,order_p.created_at,order_p.updated_at
    FROM order_p inner join product on order_p.product_id=product.product_id 
    inner join customer on order_p.customer_id = customer.customer_id 
    WHERE order_id = '$order_id'";
  $donhang = mysqli_query($connect, $sql);
  $detail_order = mysqli_fetch_array($donhang);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chhi tiết đơn hàng</title>
  <link rel="stylesheet" href="./order.css">
  <link href="../../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
  <link rel="stylesheet" href="./productStyle.css">
</head>

<body>
  <nav>
    <div class="navbar">
      <ul style="--bs-scroll-height: 100px;">
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
    </div>
    <div class="logout">
      <form method="post">
        <input type="submit" name="logout" value="Log Out">
      </form>
    </div>
  </nav>
  <div class="grid">
    <div class="order_detail">
      <h2>Thông tin đơn hàng</h2>
      <h2>Mã đơn:
        <?php echo $detail_order['order_id'] ?>
      </h2>
      <h4>Họ và tên:
        <?php echo $detail_order['customer_fullname'] ?>
      </h4>
      <h4>Số điện thoại:
        <?php echo $detail_order['customer_phone'] ?>
      </h4>
      <h4>Địa chỉ:
        <?php echo $detail_order['customer_address'] ?>
      </h4>
      <h4>Tên sản phẩm:
        <?php echo $detail_order['product_name'] ?>
      </h4>
      <h4>Số lượng:
        <?php echo $detail_order['order_quantity'] ?>
      </h4>
      <h4>Đơn giá:
        <?php echo number_format($detail_order['product_price']) . 'đ' ?>
      </h4>
      <h4>Thành tiền:
        <?php echo number_format($detail_order['product_price'] * $detail_order['order_quantity']) . 'đ' ?>
      </h4>
      <h4>Tạo lúc:
        <?php echo $detail_order['created_at'] ?>
      </h4>
      <h4>Cập nhật lúc:
        <?php echo $detail_order['updated_at'] ?>
      </h4>
    </div>
    <div class="image">
      <h4 style="display:inline;float:right;">Hình ảnh: <img
          src="../../../img/imgProduct/<?php echo $detail_order['product_image'] ?>" alt=""></h4>
    </div>
  </div>

  <script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>

</html>
<?php
mysqli_close($connect);
?>