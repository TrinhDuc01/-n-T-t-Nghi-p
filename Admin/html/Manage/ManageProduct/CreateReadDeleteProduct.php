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
$stt = 0;
//câu try vấn nối 4 bảng
$query1 = mysqli_query($connect, "SELECT * FROM product INNER JOIN material ON product.material_id = material.material_id INNER JOIN product_category ON product.category_id = product_category.category_id INNER JOIN room ON product_category.room_id = room.room_id");

if (isset($_REQUEST['delete_id'])) {
  $id = $_GET['delete_id'];
  $sql = "DELETE FROM product WHERE product_id='$id'";
  mysqli_query($connect, "DELETE FROM product_image_desc WHERE product_id='$id'");
  $xoa = mysqli_query($connect, $sql);
  header("location:CreateReadDeleteProduct.php");
}
$stt = 0;

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
  <link rel="stylesheet" href="productStyle.css">
</head>

<body>
  <?php
  require "../Nav.php ";
  ?>
  <p class="title-manage">Danh sách vật liệu<a class="add" href="CreateProduct.php" class="btn btn-primary">
    <i class="fas fa-add"></i>
    Thêm</a></p>
  <?php
      require "./paginationListProduct.php";
      pagination_List_Table('product',['material','product_category'],['material_id','category_id'],'product_id', 10, ['STT', 'Tên sản phẩm','Hình ảnh','Giá','Mô tả','Số lượng','Chất liệu','Danh mục','Thao tác'], ['product_name','product_image','product_price','product_description','product_quantity','material_name','category_name'], 'UpdatProduct');
      ?>
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