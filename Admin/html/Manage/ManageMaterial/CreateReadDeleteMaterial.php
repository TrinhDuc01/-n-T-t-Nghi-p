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
if (isset($_POST['add_material'])) {
  $material_name = $_POST['material_name'];
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  if (empty($material_name)) {
    $error['material_name'] = 'Bạn chưa nhập tên vật liệu';
  } else {
    $sqlInsert = "INSERT INTO material (material_name, created_at, updated_at) 
        VALUES ('$material_name', '$created_at', '$updated_at')";
    $query = mysqli_query($connect, $sqlInsert);
  }
}

if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM material WHERE material_id='$id'";
  $xoa = mysqli_query($connect, $sql);
}
$stt = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý vật liệu</title>
  <link href="../../../../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
  <link rel="stylesheet" href="../../../css/container.css">
  <link rel="stylesheet" href="../../../css/table.css">
  <link rel="stylesheet" href="../../../css/pagination.css">
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
  <div class="container">
    <div class="list">
      <p class="title-manage">Danh sách vật liệu</p>
      <?php
      require "../paginationListTable.php";
      pagination_List_Table('material', 'material_id', 10, ['STT', 'Tên vật liệu', 'Thao tác'], ['material_name'], 'UpdateMaterial','product');
      ?>
    </div>
    <form method="post">
      <p class="title-manage">Thêm vật liệu</p>
      <label for="disabledTextInput" class="form-label">Tên vật liệu</label>
      <input required type="text" name="material_name" id="disabledTextInput" class="form-control" placeholder="Nhập...">
      <div class="text-danger">
        <?php echo isset($error['material_name']) ? $error['material_name'] : ''; ?>
      </div>
      <button class="add" type="submit" name="add_material" class="btn btn-primary">Thêm</button>
    </form>

  </div>

  <script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
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