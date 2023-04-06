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
  <link rel="stylesheet" href="../../../css/container.css">
  <link rel="stylesheet" href="../../../css/pagination.css">
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
  
  <div class="container">
    <div class="list">
    <p class="title-manage">Danh sách danh mục sản phẩm</p>
      <?php
      require "../paginationListTable.php";
      pagination_List_Table('product_category','category_id', 10, ['STT', 'Tên danh mục', 'Thao tác'], ['category_name'],'UpdateCategory');
      ?>
    </div>
    <form method="post">
      <p class="title-manage">Thêm danh mục sản phẩm</p>
        <label for="category_name" class="form-label">Tên danh mục sản phẩm</label><br>
        <input type="text" name="category_name" id="disabledTextInput" required placeholder="Nhập..."><br>
        <label for="room_id" class="form-label">Danh mục thuộc phòng</label>
        <select name="room_id">  
          <?php
          $query3 = mysqli_query($connect, "SELECT * FROM room");
          while ($row3 = mysqli_fetch_array($query3)) {
            ?>
            <option value="<?php echo $row3['room_id'] ?>"><?php echo $row3['room_name'] ?></option>
            <?php
          }
          ?>
        </select><br>
      <button class="add" type="submit" name="add_cate">Thêm</button>
    </form>
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