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


if (isset($_POST['add_cate'])) {
  $category_name = $_POST['category_name'];
  $room_id = $_POST['room_id'];
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  if (empty($category_name)) {
    $error['category_name'] = 'Bạn chưa nhập tên danh mục';
  } else {
    $sqlInsert = "INSERT INTO product_category (category_name, room_id, created_at, updated_at) 
        VALUES ('$category_name', '$room_id', '$created_at', '$updated_at')";
    $query = mysqli_query($connect, $sqlInsert);
  }
}

if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM product_category WHERE category_id='$id'";
  $xoa = mysqli_query($connect, $sql);
}
$stt = 0;

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý Danh Mục </title>
  <link href="../../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
</head>

<body>

  <nav>
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
    <div class="logout">
      <form method="post">
        <input type="submit" name="logout" value="Log Out">
      </form>
    </div>
  </nav>
  <div style="font-family: sans-serif;font-size: 20px;margin: 20px 0px 20px 24px;">Danh sách danh mục sản phẩm</div>
  <div class="container">
    <div class="show-table">
      <table>
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Tên phòng</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = mysqli_query($connect, "SELECT * FROM product_category inner join room on product_category.room_id = room.room_id");
          while ($row = mysqli_fetch_array($query)) {
            $stt++;
            ?>
            <tr>
              <th>
                <?php echo $stt; ?>
              </th>
              <td>
                <?php echo $row['category_name']; ?>
              </td>
              <td>
                <?php echo $row['room_name']; ?>
              </td>
              <td>
                <a href="UpdateCategory.php?<?php echo 'id=' . $row['category_id']; ?>" class="btn btn-primary">
                  <i class="fas fa-edit"></i>
                </a>
                <a onclick="if(ConfirmDelete()==0) return false" href="?<?php echo 'id=' . $row['category_id']; ?>"
                  class="btn btn-danger">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="form-them">
      <form method="post">
        <fieldset>
          <legend>Thêm danh mục sản phẩm</legend>
          <div>
            <label for="disabledTextInput" class="form-label">Tên danh mục sản phẩm</label>
            <input type="text" name="category_name" id="disabledTextInput" required placeholder="Nhập...">
            <div class="text-danger">
              <?php echo isset($error['category_name']) ? $error['category_name'] : ''; ?>
            </div>
            <label for="room_id" class="form-label">Danh mục thuộc phòng</label>
            <select class="form-select" name="room_id" id="room_id" aria-label="Default select example">
              <?php
              $query3 = mysqli_query($connect, "SELECT * FROM room");
              while ($row3 = mysqli_fetch_array($query3)) {
                ?>
                <option value="<?php echo $row3['room_id'] ?>"><?php echo $row3['room_name'] ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <button type="submit" name="add_cate">Thêm</button>
        </fieldset>
      </form>
    </div>
  </div>

</body>

</html>
<script type="text/javascript">
  function ConfirmDelete() {
    let choice = confirm("Bạn có muốn xoá");
    if (choice == true) {
      return 1;
    }
    else
      return 0;
  }
</script>
<?php
mysqli_close($connect);
?>