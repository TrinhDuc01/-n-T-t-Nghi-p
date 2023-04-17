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
if (isset($_POST['add_room'])) {
  $room_name = $_POST['room_name'];
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  if (empty($room_name)) {
    $error['room_name'] = 'Bạn chưa nhập tên phòng';
  } else {
    $sqlInsert = "INSERT INTO room (room_name, created_at, updated_at) 
        VALUES ('$room_name', '$created_at', '$updated_at')";
    $query = mysqli_query($connect, $sqlInsert);
  }
}

if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM room WHERE room_id='$id'";
  $xoa = mysqli_query($connect, $sql);
}
$stt = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý Phòng</title>
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
  <div class="container">
    <div class="list">
      <p class="title-manage">Danh sách Phòng</p>
      <?php
      require "../paginationListTable.php";
      pagination_List_Table('room','room_id', 10, ['STT', 'Tên phòng', 'Thao tác'], ['room_name'], 'UpdateRoom');
      ?>
    </div>

    <form method="post">
        <p class="title-manage">Thêm phòng</p>
          <label for="disabledTextInput" class="form-label">Tên phòng</label><br>
          <input type="text" required name="room_name" id="disabledTextInput" class="form-control" placeholder="Nhập...">
          <div class="text-danger">
            <?php echo isset($error['room_name']) ? $error['room_name'] : ''; ?>
          </div>
        <button class="add" type="submit" name="add_room">Thêm</button>
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