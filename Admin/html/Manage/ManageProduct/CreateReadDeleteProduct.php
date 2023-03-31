<?php
session_start();
require "../../../../connect.php";
if(isset($_SESSION['admin_login'])){
  
}
else{
  header("location:../../LoginAdmin.php");
}
if(isset($_POST['logout'])){
  unset($_SESSION['admin_login']);
  header("location:../../LoginAdmin.php");
}
$stt=0;
//câu try vấn nối 4 bảng
$query1 = mysqli_query($connect,"SELECT * FROM product INNER JOIN material ON product.material_id = material.material_id INNER JOIN product_category ON product.category_id = product_category.category_id INNER JOIN room ON product_category.room_id = room.room_id");

if(isset($_REQUEST['delete_id'])){
$id = $_GET['delete_id'];
$sql = "DELETE FROM product WHERE product_id='$id'";
mysqli_query($connect,"DELETE FROM product_image_desc WHERE product_id='$id'");
$xoa = mysqli_query($connect,$sql);
header("location:CreateReadDeleteProduct.php");
}
$stt=0;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ Admin</title>
  <link rel="stylesheet" type="text/css" href="../../../bootstrap-5.0.2-dist/css/bootstrap.css">
  <link href="../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
  <style type="text/css">
    tr td{
      line-height: 100px;
    }
  </style>
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
<div><a href="CreateProduct.php" class="btn btn-primary">
          <i class="fas fa-add"></i>
         Thêm</a></div>
<div>
  <table class="table table-bordered table-hover">
  <thead>
    <tr class="text-center ">
      <th scope="col">STT</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Giá</th>
      <th scope="col">Mô tả</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Danh mục</th>
      <th scope="col">Chất liệu</th>
      <th scope="col">Phòng</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      while($product_info = mysqli_fetch_array($query1)){
        $stt++;
        // $id_cate = $product_info['category_id'];
        // $query2 = mysqli_query($connect,"SELECT * FROM product_category WHERE category_id = '$id_cate'"); 
        // $cate = mysqli_fetch_array($query2);
        // $id_room = $product_info['category_id']; 
        // $query3 = mysqli_query($connect,"SELECT * FROM product_category WHERE category_id = '$id_cate'"); 
        // $room = mysqli_fetch_array($query3);
        // $id_material = $product_info['category_id']; 
        // $query4 = mysqli_query($connect,"SELECT * FROM product_category WHERE category_id = '$id_cate'"); 
        // $material = mysqli_fetch_array($query4);
    ?>
    <tr class="text-center ">
      <td scope="row"><?php echo $stt ?></td>
      <td scope="row"><?php echo $product_info['product_name'] ?></td>
      <td class="text-center"><img height="100px" src="../../imgAdmin/<?php echo $product_info['product_image'] ?>"></td>
      <td><?php echo $product_info['product_price'] ?></td>
      <td>...</td>
      <td><?php echo $product_info['product_quantity'] ?></td>
      <td><?php echo $product_info['category_name'] ?></td>
      <td><?php echo $product_info['material_name'] ?></td>
      <td><?php echo $product_info['room_name'] ?></td>
      <td class="text-center "><?php echo $product_info['product_status'] == 1 ? '<button type="" name="add_product" class="btn btn-success"><i class="fa-solid fa-check"></i> Kích hoạt</button>' : '<button type="" name="add_product" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Không kích hoạt</button>';?></td>
      <td class="text-center">
        <a href="UpdateProduct.php?<?php echo 'edit_id='.$product_info['product_id'];?>" class="btn btn-primary">
          <i class="fas fa-edit"></i>
        </a>
        <a onclick="if(ConfirmDelete()==0) return false" href="?<?php echo 'delete_id='.$product_info['product_id'];?>" class="btn btn-danger">
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