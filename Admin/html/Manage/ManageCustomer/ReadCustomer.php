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
            <td><a
                style="background-color: lightblue;color: black; text-decoration:none; border-radius:5px; padding: 5px 10px;"
                href="./ViewCustomer.php?id=<?php echo $row['customer_id'] ?>">Xem chi tiết</a></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>

<?php
mysqli_close($connect);
?>