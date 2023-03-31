<?php
session_start();
require "../../../connect.php";
if(!isset($_SESSION['loged'])){
  header("location:../../LoginAdmin.php");
}

if(isset($_POST['logout'])){
  unset($_SESSION['loged']);
  header("location:../../LoginAdmin.php");
}
if(isset($_POST['add_material'])){
  $material_name = $_POST['material_name'];
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  if (empty($material_name)){
    $error['material_name'] = 'Bạn chưa nhập tên vật liệu';
  }
  else{
    $sqlInsert = "INSERT INTO material (material_name, created_at, updated_at) 
        VALUES ('$material_name', '$created_at', '$updated_at')";
    $query = mysqli_query($connect,$sqlInsert);
  }
}

if(isset($_REQUEST['id'])){
$id = $_GET['id'];
$sql = "DELETE FROM material WHERE material_id='$id'";
$xoa = mysqli_query($connect,$sql);
}
$stt=0;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý Danh Mục </title>
  <link rel="stylesheet" type="text/css" href="../../../bootstrap-5.0.2-dist/css/bootstrap.css">
  <link href="../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageProduct/CreateReadDeleteProduct.php">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageCategory/CreateReadDeleteCategory.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageRoom/CreateReadDeleteRoom.php">Quản lý phòng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageMaterial/CreateReadDeleteMaterial.php">Quản lý vật liệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageCustomer/ReadCustomer.php">Quản lý khách hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../ManageOrder/ReadOrder.php">Quản lý đơn hàng</a>
        </li>
      </ul>
      <form class="d-flex" method="post">
        <input class="btn btn-danger" type="submit" name="logout" value="Log Out">
      </form>
    </div>
  </div>
</nav>
<div style="font-family: sans-serif;font-size: 20px;margin: 20px 0px 20px 24px;">Danh sách vật liệu</div>
<div class="container-fluid row">
  <div class="col-8">
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="">STT</th>
      <th class="col-10">Tên vật liệu</th>
      <th class="text-center">Thao tác</th>
    </tr>
  </thead>
  <tbody>

<?php
$query = mysqli_query($connect,"SELECT * FROM material");
while ($row = mysqli_fetch_array($query)) {
  $stt++;
?>
    <tr>
      <th scope="row"><?php echo $stt;?></th>
      <td><?php echo $row['material_name'];?></td>
      <td class="text-center">
        <a href="UpdateMaterial.php?<?php echo 'id='.$row['material_id'];?>" class="btn btn-primary">
          <i class="fas fa-edit"></i>
        </a>
        <a onclick="if(ConfirmDelete()==0) return false" href="?<?php echo 'id='.$row['material_id'];?>" class="btn btn-danger">
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
<div class="col-4">
  <form method="post">
  <fieldset>
    <legend>Thêm vật liệu</legend>
    <div class="mb-3">
      <label for="disabledTextInput" class="form-label">Tên vật liệu</label>
      <input type="text" name="material_name" id="disabledTextInput" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['material_name']) ? $error['material_name']:''; ?> </div>
    </div>
    <button type="submit" name="add_material" class="btn btn-primary">Thêm</button>
  </fieldset>
</form>
</div>
</div>

<script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>
<script type="text/javascript">
  function ConfirmDelete() {
    let choice = confirm("Bạn có muốn xoá");
    if(choice==true){
      return 1;
    }
    else 
      return 0;
  }
</script>
<?php
mysqli_close($connect);
?>