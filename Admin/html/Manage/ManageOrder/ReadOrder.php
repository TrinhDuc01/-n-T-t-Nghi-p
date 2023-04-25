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
  mysqli_query($connect, "UPDATE order_p SET order_status=1 WHERE order_id='$duyet_id' AND order_status=0 AND NOT order_status=1 AND NOT order_status=2 AND NOT order_status=4");
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
  <?php // phan trang
  $queryRows = mysqli_query($connect, "SELECT * FROM `order_p`");
  $totalRows = mysqli_num_rows($queryRows);
  $pageSize = 12; // số dòng tối đa trong 1 trang
  $totalPage = 1; // tính  tổng số trang
  
  // print_r($tencot);
  
  if ($totalRows % $pageSize == 0) {
    $totalPage = $totalRows / $pageSize;
  } else {
    $totalPage = (int) ($totalRows / $pageSize) + 1;
  }

  $rowStart = 1;
  $pageCurrent = 1;

  if ((!isset($_GET['page'])) || ($_GET['page'] == 1)) {
    $rowStart = 0;
    $pageCurrent = 1;
  } else {
    $rowStart = ($_GET['page'] - 1) * $pageSize;
    $pageCurrent = $_GET['page'];
  }

  ?>
  <div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="text-center">
          <th scope="col">Mã đơn hàng</th>
          <th scope="col">Tên người nhận</th>
          <th scope="col">Số điện thoại người nhận</th>
          <th scope="col">Địa chỉ nhận hàng</th>
          <th scope="col">Tên người đặt</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Duyệt</th>
          <th scope="col">Chi tiết</th>
          <th scope="col">Ngày đặt</th>
          <th scope="col">In hoá đơn</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM customer inner join order_p on order_p.customer_id = customer.customer_id ORDER BY order_id DESC LIMIT {$rowStart} , {$pageSize}";
        $donhang = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($donhang)) {
          ?>
          <tr style="<?php echo $row['order_status'] == 4 ? 'opacity:0.5;' : '' ?>">
            <td>
              <?php echo $row['order_id'] ?>
            </td>
            <td>
              <?php echo $row['receiver_name'] ?>
            </td>
            <td>
              <?php echo $row['receiver_phonenumber'] ?>
            </td>
            <td>
              <?php echo $row['receiver_address'] ?>
            </td>
            <td>
              <?php echo $row['customer_fullname'] ?>
            </td>
            <td>
              <?php
              if ($row['order_status'] == 0) {
                echo '<button class="btn btn-danger">Chưa duyệt</button>';
              } else if ($row['order_status'] == 1) {
                echo '<button class="btn btn-success">Đã duyệt</button>';
              } else if ($row['order_status'] == 2) {
                echo '<button class="NO">Đang giao</button>';
              } else
                echo '<button class="btn btn-danger"><i class="fa-solid fa-xmark"></i> KH đã huỷ đơn</button>';
              ?>
            </td>
            <td>
              <a onclick="if(ConfirmUpdate()==0) return false" href="?<?php echo 'duyet_id=' . $row['order_id']; ?>"
                class="btn btn-primary">
                <i class="fa-solid fa-check"></i>
              </a>
            </td>
            <td>
              <a href="./DetailOrder.php?<?php echo 'order_id=' . $row['order_id']; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i>
              </a>
            </td>
            <td>
              <?php echo $row['created_at']; ?>
            </td>
            <td>
              <a href="./indonhang.php?<?php echo 'order_id=' . $row['order_id']; ?>" class="btn btn-primary">
                In đơn hàng
              </a>
            </td>
          </tr>

          <?php
        }
        ?>
      </tbody>
    </table>

  </div>
  <div style="margin:0 0 50px 50px">
    Trang:
    <?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : 1 ?>
    <div class="pagination">
      <?php
      for ($i = 1; $i <= $totalPage; $i++) {
        if ($pageCurrent == $i) {
          echo "<a>" . $i . "</a>";
        } else {
          ?>
          <a href="?page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
          <?php
        }
      }
      ?>
    </div>
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