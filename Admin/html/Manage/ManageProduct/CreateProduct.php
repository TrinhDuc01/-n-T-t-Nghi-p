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


if(isset($_POST['add_product'])){
  $files = '';
  $image_urls = '';
  $id_product_after_insert = '';
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_decription = $_POST['product_decription'];
  $product_quantity = $_POST['product_quantity'];
  $product_size = $_POST['product_size'];
  $material_id = $_POST['material_id'];
  $category_id = $_POST['category_id'];
  //kiểm tra ảnh
  if(isset($_FILES['product_image'])){
    $file = $_FILES['product_image'];
    $product_image = $file['name'];
    if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png'){
      move_uploaded_file($file['tmp_name'], '../../imgAdmin/'.$product_image);
    }
    else{
      $error['product_image'] = "Không đúng định dạng";
    }
  }
  $product_status = $_POST['product_status'];
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  //kiểm tra
  if (empty($product_name)) {
        $error['product_name'] = "Tên sản phẩm không được để trống";
    }
  //kiểm tra
  if(empty($product_quantity)){
    $error['product_quantity'] = "Số lượng sản phẩm không được để trống";
  }
  else{
    if (!is_numeric($product_quantity))
      {
    $error['product_quantity'] = "Số lượng sản phẩm phải là số";
  }
  }
  //kiểm tra
  if(empty($product_price)){
    $error['product_price'] = "Giá sản phẩm không được để trống";
  }
  else{
    if (!is_numeric($product_price))
      {
    $error['product_price'] = "Giá sản phẩm phải là số";
  }
  }
  //kiểm tra
  if (empty($product_decription)) {
        $error['product_decription'] = "Mô tả sản phẩm không được để trống";
  }
//thêm sản phẩm
  if(empty($error['product_image']) && empty($error['product_name']) && empty($error['product_quantity']) && empty($error['product_price']) && empty($error['product_decription'])){
    $sqlInsert = "INSERT INTO product (product_name, product_price, product_decription, product_quantity, product_size, product_image, product_status, material_id, category_id, created_at, updated_at) 
        VALUES ('$product_name', '$product_price', '$product_decription', '$product_quantity','$product_size','$product_image','$product_status', '$material_id', '$category_id', '$created_at', '$updated_at')";
    $query = mysqli_query($connect,$sqlInsert);
    $id_product_after_insert = mysqli_insert_id($connect);

  }

//thêm nhiều ảnh

  

  if(isset($_FILES['product_images'])){
    $files = $_FILES['product_images'];
    $image_urls = $files['name'];

    foreach ($image_urls as $key => $value) {
      if(empty($files['name'][$key])){
        $error['product_images'] = 'Ảnh không được để trống';
        break;
      }
      else{
        move_uploaded_file($files['tmp_name'][$key], '../../imgAdmin/'.$value);
      mysqli_query($connect,"INSERT INTO product_image_desc(image_url,product_id,created_at) VALUES ('$value','$id_product_after_insert','$created_at')");
      header('location:CreateReadDeleteProduct.php');
      }
    }
  }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ Admin</title>
  <link rel="stylesheet" type="text/css" href="../../../bootstrap-5.0.2-dist/css/bootstrap.css">
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
<div class="row">
  <div class="col-4"></div>
  <div class="col-4">
  <form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Thêm sản phẩm</legend>
    <div class="mb-3">
      <label for="product_name" class="form-label">Tên sản phẩm</label>
      <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_name']) ? $error['product_name']:''; ?> </div>

      <label for="product_price" class="form-label">Giá sản phẩm</label>
      <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_price']) ? $error['product_price']:''; ?> </div>

      <label for="product_decription" class="form-label">Mô tả sản phẩm</label>
      <input type="text" name="product_decription" id="product_decription" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_decription']) ? $error['product_decription']:''; ?> </div>

      <label for="product_quantity" class="form-label">Số lượng sản phẩm</label>
      <input type="text" name="product_quantity" id="product_quantity" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_quantity']) ? $error['product_quantity']:''; ?> </div>

      <label for="product_size" class="form-label">Kích thước sản phẩm</label>
      <input type="text" name="product_size" id="product_size" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_size']) ? $error['product_size']:''; ?> </div>

      <label for="product_image" class="form-label">Ảnh sản phẩm</label>
      <input type="file" name="product_image" id="product_image" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_image']) ? $error['product_image']:''; ?> </div>

      <label for="product_images" class="form-label">Ảnh mô tả sản phẩm</label>
      <input type="file" name="product_images[]" id="product_images" class="form-control" multiple="mutiple" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_images']) ? $error['product_images']:''; ?> </div>

      <label for="material_id" class="form-label">Sản phẩm làm từ</label>
      <select class="form-select" name="material_id" id="material_id" aria-label="Default select example">
        <?php 
          $query1 = mysqli_query($connect,"SELECT * FROM material");
          while ($row = mysqli_fetch_array($query1)) {
            ?>
            <option value="<?php echo $row['material_id']?>"><?php echo $row['material_name'] ?></option>
        <?php
          }
        ?>
      </select>

      <label for="category_id" class="form-label">Sản phẩm thuộc danh mục</label>
      <select class="form-select" name="category_id" id="category_id" aria-label="Default select example">
        <?php 
          $query2 = mysqli_query($connect,"SELECT * FROM product_category");
          while ($row = mysqli_fetch_array($query2)) {
        ?>
        <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name'] ?></option>
        <?php
        }
        ?>
      </select>
</div>
</div>
    </div>
    <div class="text-center">
      <button type="submit" name="add_product" class="btn btn-primary">Thêm</button>
    </div>
  </fieldset>
</form>
</div>

</div>
<script type="text/javascript" src="../../../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</body>
</html>
<?php
mysqli_close($connect);
?>