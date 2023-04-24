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
  $sql = "SELECT *
    FROM detail_order inner join product on detail_order.product_id=product.product_id 
    WHERE detail_order.order_id = '$order_id'";
  $donhang = mysqli_query($connect, $sql);

}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chi tiết đơn hàng</title>
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
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Hình ảnh</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Đơn giá</th>
          <th scope="col">Thành tiền</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tong_tien = 0;
        while ($detail_order = mysqli_fetch_array($donhang)) {
          $tong_tien += $detail_order['product_price'] * $detail_order['order_quantity'];
          ?>

          <tr class="text-center">
            <td>
              <?php echo $detail_order['product_name'] ?>
            </td>
            <td>
              <img src="../../../img/imgProduct/<?php echo $detail_order['product_image'] ?>" alt="" srcset="">
            </td>
            <td>
              <?php echo $detail_order['order_quantity'] ?>
            </td>
            <td>
              <?php echo number_format($detail_order['product_price']) . ' đ'; ?>
            </td>
            <td>
              <?php echo number_format($detail_order['product_price'] * $detail_order['order_quantity']) . ' đ' ?>
            </td>
            <?php
        }
        ?>
        <tr>
          <td colspan=4 >Tổng tiền</td>
          <td>
            <?php echo number_format($tong_tien) . ' đ' ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


</body>
<script type="text/javascript">
  function ConfirmUpdate() {
    let choice = confirm("Bạn có muốn duyệt đơn này");
    if (choice == true) {
      return 1;
    }
    else
      return 0;
  }
</script>

</html>
<?php
mysqli_close($connect);
?>