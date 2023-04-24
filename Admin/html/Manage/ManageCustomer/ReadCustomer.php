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
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý khách hàng</title>
  <link href="../../../../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
  <link rel="stylesheet" href="../../../css/container.css">
  <link rel="stylesheet" href="../../../css/pagination.css">
  <link rel="stylesheet" href="../../../css/table.css">
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
  <?php // phan trang
  $queryRows = mysqli_query($connect, "SELECT * FROM `customer`");
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
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Họ và tên</th>
          <th scope="col">Số điện thoại</th>
          <th scope="col">Địa chỉ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sqlkh = mysqli_query($connect, "SELECT * FROM customer LIMIT {$rowStart} , {$pageSize}");
        $stt = 0;
        while ($row = mysqli_fetch_array($sqlkh)) {
          $stt++;
          ?>
          <tr>
            <th>
              <?php echo $stt ?>
            </th>
            <td>
              <?php echo $row['customer_fullname'] ?>
            </td>
            <td>
              <?php echo $row['customer_phone'] ?>
            </td>
            <td>
              <?php echo $row['customer_address'] ?>
            </td>
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

</html>

<?php
mysqli_close($connect);
?>