<?php
session_start();
require "../../../../connect.php";
if (!isset($_SESSION['admin_login'])) {
  header("location:../../LoginAdmin.php");
}

if (isset($_POST['logout'])) {
  unset($_SESSION['admin_login']);
  header("location:../../LoginAdmin.php");
}


if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM product_category WHERE category_id='$id'";
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
  <link rel="stylesheet" href="../../../css/style.css">
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
  <div>
    <form method="post">
      <fieldset>
        <legend>Sửa danh mục sản phẩm</legend>
        <div class="mb-3">
          <label for="disabledTextInput" class="form-label">Tên danh mục sản phẩm</label>
          <input type="text" name="category_name" value="<?php echo $row['category_name'] ?>" id="disabledTextInput"
            class="form-control" placeholder="Nhập...">
          <div class="text-danger">
            <?php echo isset($error['category_name']) ? $error['category_name'] : ''; ?>
          </div>
          <label for="room_id" class="form-label">Danh mục thuộc phòng</label>
          <select class="form-select" name="room_id" id="room_id" aria-label="Default select example">
            <?php
            $query3 = mysqli_query($connect, "SELECT * FROM room");
            while ($row3 = mysqli_fetch_array($query3)) {
              ?>
              <option value="<?php echo $row3['room_id'] ?>" <?php echo (($row['room_id'] == $row3['room_id']) ? 'selected' : ''); ?>><?php echo $row3['room_name']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <button type="submit" onclick="if(ConfirmUpdate()==0) return false" name="edit_cate"
          class="btn btn-primary">Sửa</button>
      </fieldset>
    </form>
  </div>
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
if (isset($_POST['edit_cate'])) {
  $category_name = $_POST['category_name'];
  $room_id = $_POST['room_id'];
  $updated_at = date('Y-m-d H:i:s');
  if (empty($category_name)) {
    $error['category_name'] = 'Bạn chưa nhập tên danh mục';
  } else {
    $sqlUpdate = "UPDATE product_category SET category_name='$category_name',room_id='$room_id',updated_at='$updated_at' WHERE category_id='$id'";
    $query = mysqli_query($connect, $sqlUpdate);
    header('location:CreateReadDeleteCategory.php');
  }
}
?>

<?php
mysqli_close($connect);
?>