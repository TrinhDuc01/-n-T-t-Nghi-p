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
    <form method="post">
        <p class="title-manage">Sửa danh mục sản phẩm</p>
        <label for="category_name" class="form-label">Tên danh mục sản phẩm</label><br>
        <input type="text" name="category_name" value="<?php echo $row['category_name'] ?>" id="disabledTextInput" required placeholder="Nhập..."><br>
        <label for="room_id" class="form-label">Danh mục thuộc phòng</label>
        <select name="room_id">  
          <?php
          $query3 = mysqli_query($connect, "SELECT * FROM room");
          while ($row3 = mysqli_fetch_array($query3)) {
            ?>
            <option value="<?php echo $row3['room_id']?>" <?php echo (($row['room_id']==$row3['room_id'])?'selected':''); ?>><?php echo $row3['room_name']; ?></option>
            <?php
          }
          ?>
        </select><br>
        <button type="submit" onclick="if(ConfirmUpdate()==0) return false" name="edit_cate"
          class="add">Sửa</button>
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