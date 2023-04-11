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


if (isset($_POST['add_product'])) {
  $files = '';
  $image_urls = '';
  $id_product_after_insert = '';
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_description = $_POST['product_description'];
  $product_quantity = $_POST['product_quantity'];
  $product_size = $_POST['product_size'];
  $material_id = $_POST['material_id'];
  $category_id = $_POST['category_id'];
  //kiểm tra ảnh
  if (isset($_FILES['product_image'])) {
    $file = $_FILES['product_image'];
    $product_image = $file['name'];
    if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
      move_uploaded_file($file['tmp_name'], '../../../img/imgProduct/' . $product_image);
    } else {
      $error['product_image'] = "Không đúng định dạng";
    }
  }
  $product_status = 1;
  $created_at = date('Y-m-d H:i:s');
  $updated_at = NULL;
  //thêm sản phẩm
  if (empty($error['product_image']) && empty($error['product_name']) && empty($error['product_quantity']) && empty($error['product_price']) && empty($error['product_decription'])) {
    $sqlInsert = "INSERT INTO product (product_name, product_price, product_description, product_quantity, product_size, product_image, product_status, material_id, category_id, created_at, updated_at) 
        VALUES ('$product_name', '$product_price', '$product_description', '$product_quantity','$product_size','$product_image','$product_status', '$material_id', '$category_id', '$created_at', '$updated_at')";
    $query = mysqli_query($connect, $sqlInsert);
    $id_product_after_insert = mysqli_insert_id($connect);

  }

  //thêm nhiều ảnh



  if (isset($_FILES['product_images'])) {
    $files = $_FILES['product_images'];
    $image_urls = $files['name'];

    foreach ($image_urls as $key => $value) {
      if (empty($files['name'][$key])) {
        $error['product_images'] = 'Ảnh không được để trống';
        break;
      } else {
        move_uploaded_file($files['tmp_name'][$key], '../../../img/imgProduct/' . $value);
        mysqli_query($connect, "INSERT INTO product_image_desc(image_url,product_id,created_at) VALUES ('$value','$id_product_after_insert','$created_at')");
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
  <link href="../../../../icon/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/navbar.css">
  <link rel="stylesheet" href="./productStyle.css">
</head>

<body>

  <?php
  require "../Nav.php ";
  ?>
  <form method="post" enctype="multipart/form-data" class="form_product">
    <p class="title-manage">Sửa sản phẩm</p>
    <label for="product_name" class="form-label">Tên sản phẩm</label>
    <input required type="text" name="product_name" id="product_name" class="form-control" placeholder="Nhập...">


    <label for="product_price" class="form-label">Giá sản phẩm</label>
    <input required type="text" name="product_price" id="product_price" class="form-control" placeholder="Nhập...">


    <label for="product_decription" class="form-label">Mô tả sản phẩm</label>
    <input required type="text" name="product_description" id="product_decription" class="form-control"
      placeholder="Nhập...">


    <label for="product_quantity" class="form-label">Số lượng sản phẩm</label>
    <input required type="text" name="product_quantity" id="product_quantity" class="form-control"
      placeholder="Nhập...">

    <label for="product_size" class="form-label">Kích thước sản phẩm</label>
    <input required type="text" name="product_size" id="product_size" class="form-control" placeholder="Nhập...">


    <label for="product_image" class="form-label">Ảnh sản phẩm</label>
    <input required type="file" name="product_image" id="product_image" class="form-control" placeholder="Nhập...">

    <label for="product_images" class="form-label">Ảnh mô tả sản phẩm</label>
    <input required type="file" name="product_images[]" id="product_images" class="form-control" multiple="mutiple"
      placeholder="Nhập...">



    <label for="material_id" class="form-label">Sản phẩm làm từ</label>
    <select class="form-select" name="material_id" id="material_id" aria-label="Default select example">
      <?php
      $query1 = mysqli_query($connect, "SELECT * FROM material");
      while ($row = mysqli_fetch_array($query1)) {
        ?>
        <option value="<?php echo $row['material_id'] ?>"><?php echo $row['material_name'] ?></option>
        <?php
      }
      ?>
    </select>

    <label for="category_id" class="form-label">Sản phẩm thuộc danh mục</label>
    <select class="form-select" name="category_id" id="category_id" aria-label="Default select example">
      <?php
      $query2 = mysqli_query($connect, "SELECT * FROM product_category");
      while ($row = mysqli_fetch_array($query2)) {
        ?>
        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
        <?php
      }
      ?>
    </select>
    <div class="text-center">
      <button type="submit" name="add_product" class="success">Thêm</button>
    </div>
  </form>

</body>

</html>
<?php
mysqli_close($connect);
?>