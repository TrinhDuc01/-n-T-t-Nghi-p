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
  $sql = "SELECT * FROM room WHERE room_id='$id'";
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
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
  <div class="container">
    <form method="post">
      <p class="title-manage">Sửa thông tin phòng</p>
      <div class="mb-3">
        <label class="form-label">Tên phòng</label><br>
        <input type="text" name="room_name" value="<?php echo $row['room_name'] ?>" placeholder="Nhập...">
        <div class="text-danger">
          <?php echo isset($error['room_name']) ? $error['room_name'] : ''; ?>
        </div>
      </div>
      <button type="submit" class="add" onclick="if(ConfirmUpdate()==0) return false" name="edit_room"
        class="btn btn-primary">Sửa</button>
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
if (isset($_POST['edit_room'])) {
  $room_name = $_POST['room_name'];
  $updated_at = date('Y-m-d H:i:s');
  if (empty($room_name)) {
    $error['room_name'] = 'Bạn chưa nhập tên danh mục';
  } else {
    $sqlUpdate = "UPDATE room SET room_name='$room_name',updated_at='$updated_at' WHERE room_id='$id'";
    $query = mysqli_query($connect, $sqlUpdate);
    header('location:CreateReadDeleteRoom.php');
  }
}
?>
<?php
mysqli_close($connect);
?>