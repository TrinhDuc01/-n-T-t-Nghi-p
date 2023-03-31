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
if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM material WHERE material_id='$id'";
  $sua = mysqli_query($connect, $sql);
  $row = mysqli_fetch_array($sua);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ Admin</title>
  <link rel="stylesheet" type="text/css" href="../../../bootstrap-5.0.2-dist/css/bootstrap.css">
  <link href="../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
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
  <div class="col-4">
    <form method="post">
      <fieldset>
        <legend>Sửa vật liệu</legend>
        <div class="mb-3">
          <label for="disabledTextInput" class="form-label">Tên vật liệu</label>
          <input type="text" name="material_name" value="<?php echo $row['material_name'] ?>" id="disabledTextInput"
            class="form-control" placeholder="Nhập...">
          <div class="text-danger">
            <?php echo isset($error['material_name']) ? $error['material_name'] : ''; ?>
          </div>
        </div>
        <button type="submit" onclick="if(ConfirmUpdate()==0) return false" name="edit_material"
          class="btn btn-primary">Sửa</button>
      </fieldset>
    </form>
  </div>

  <script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>

</html>
<script type="text/javascript">
  function ConfirmUpdate() {
    let choice = confirm("Bạn có muốn sửa");
    if (choice == true) {
      return 1;
    }
    else
      return 0;
  }
</script>
<?php
if (isset($_POST['edit_material'])) {
  $material_name = $_POST['material_name'];
  $updated_at = date('Y-m-d H:i:s');
  if (empty($material_name)) {
    $error['material_name'] = 'Bạn chưa nhập tên vật liệu';
  } else {
    $sqlUpdate = "UPDATE material SET material_name='$material_name',updated_at='$updated_at' WHERE material_id='$id'";
    $query = mysqli_query($connect, $sqlUpdate);
    header('location:CreateReadDeleteMaterial.php');
  }
}
?>
<?php
mysqli_close($connect);
?>