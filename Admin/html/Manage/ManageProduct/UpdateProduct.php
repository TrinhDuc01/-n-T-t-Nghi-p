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
$error['product_quantity'] = '';
$error['product_price'] = '';
$error['product_image'] = '';
$error['product_images'] = "";

if (isset($_GET['edit_id'])) {
  $id = $_GET['edit_id'];
  //câu try vấn nối 4 bảng
  $query1 = mysqli_query($connect, "SELECT * FROM product INNER JOIN material ON product.material_id = material.material_id INNER JOIN product_category ON product.category_id = product_category.category_id INNER JOIN room ON product_category.room_id = room.room_id WHERE product_id = '$id'");

  $print_value = mysqli_fetch_array($query1); //san pham

  $query_img_mota = mysqli_query($connect, "SELECT * FROM product_image_desc WHERE product_id = '$id'");
}

if (isset($_POST['edit_product'])) {
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
  // print_r($_FILES['product_image']);
  // die();
  if (!is_numeric($product_quantity)) {
    $error['product_quantity'] = 'Số lượng sản phẩm phải là số!';
  } else {
    $error['product_quantity'] = '';
  }
  if (!is_numeric($product_price)) {
    $error['product_price'] = 'Giá sản phẩm phải là số!';
  } else {
    $error['product_price'] = '';
  }
  //kiểm tra ảnh
  if (isset($_FILES['product_image'])) {
    $file = $_FILES['product_image'];
    $product_image = $file['name'];
    // echo 'empty($product_image)';
    // die();
    //truong hop nguoi dung khong chon anh
    if (empty($product_image)) {
      $product_image = $print_value['product_image'];
    }
    //truong hop nguoi dung chon anh
    else {
      if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
        move_uploaded_file($file['tmp_name'], '../../../img/imgAdmin/' . $product_image);
      } else {
        $error['product_image'] = "Không đúng định dạng";
      }
    }

  }
  $updated_at = date('Y-m-d H:i:s');

  //Sửa nhiều ảnh
  if (isset($_FILES['product_images']) && empty($error['product_price']) && empty($error['product_quantity'])) {
    $files = $_FILES['product_images'];
    $image_urls = $files['name'];

    if (!empty($image_urls[0])) {
      mysqli_query($connect, "DELETE FROM product_image_desc WHERE product_id='$id'");
      foreach ($image_urls as $key => $value) {
        if (!empty($files['name'][$key])) {
          move_uploaded_file($files['tmp_name'][$key], '../../../img/imgProduct/' . $value);
          mysqli_query($connect, "INSERT INTO product_image_desc(image_url,product_id,updated_at) VALUES ('$value','$id','$updated_at')");
        }
      }
    }
    //Sửa sản phẩm

  }

  if (empty($error['product_price']) && empty($error['product_quantity'])) {
    $sqlUpdate = "UPDATE product SET product_name='$product_name', product_price='$product_price', product_description='$product_description', product_quantity='$product_quantity', product_size='$product_size', product_image='$product_image', material_id='$material_id', category_id='$category_id',updated_at='$updated_at' WHERE product_id = '$id'";
    $query = mysqli_query($connect, $sqlUpdate);
    if ($query) {
      echo 'ok';
      header('location:CreateReadDeleteProduct.php');
    }
  }

}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sửa sản phẩm</title>
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
    <input required type="text" value="<?php echo $print_value['product_name'] ?>" name="product_name" id="product_name"
      class="form-control" placeholder="Nhập...">
    <div class="text-danger">
      <?php echo isset($error['product_name']) ? $error['product_name'] : ''; ?>
    </div>

    <label for="product_price" class="form-label">Giá sản phẩm</label>
    <input required type="text" value="<?php echo $print_value['product_price'] ?>" name="product_price"
      id="product_price" class="form-control" placeholder="Nhập...">
    <div class="text-danger" style="color:red">
      <?php echo isset($error['product_price']) ? $error['product_price'] : ''; ?>
    </div>

    <label for="product_decription" class="form-label">Mô tả sản phẩm</label>
    <input required type="text" value="<?php echo $print_value['product_description'] ?>" name="product_description"
      id="product_decription" class="form-control" placeholder="Nhập...">
    <div class="text-danger">
      <?php echo isset($error['product_decription']) ? $error['product_decription'] : ''; ?>
    </div>

    <label for="product_quantity" class="form-label">Số lượng sản phẩm</label>
    <input required type="text" value="<?php echo $print_value['product_quantity'] ?>" name="product_quantity"
      id="product_quantity" class="form-control" placeholder="Nhập...">
    <div class="text-danger" style="color:red">
      <?php echo isset($error['product_quantity']) ? $error['product_quantity'] : ''; ?>
    </div>

    <label for="product_size" class="form-label">Kích thước sản phẩm</label>
    <input required type="text" value="<?php echo $print_value['product_size'] ?>" name="product_size" id="product_size"
      class="form-control" placeholder="Nhập...">
    <div class="text-danger">
      <?php echo isset($error['product_size']) ? $error['product_size'] : ''; ?>
    </div>

    <label for="product_image" class="form-label">Ảnh sản phẩm</label>
    <input type="file" name="product_image" id="product_image" class="form-control" placeholder="Nhập...">
    <img class="form-control" src="<?php echo '../../../img/imgProduct/' . $print_value['product_image'] ?>">
    <div class="text-danger">
      <?php echo isset($error['product_image']) ? $error['product_image'] : ''; ?>
    </div>
    <label for="product_images" class="form-label">Ảnh mô tả sản phẩm</label>
    <inputtype="file" name="product_images[]" id="product_images" class="form-control" multiple="mutiple"
      placeholder="Nhập...">
      <div class="text-danger">
        <?php echo isset($error['product_images']) ? $error['product_images'] : ''; ?>
      </div>

      <div class="image-desc">
        <?php
        foreach ($query_img_mota as $key => $value) {
          ?>
          <img style="max-width: 250px;" class="thumbnail"
            src="<?php echo '../../../img/imgProduct/' . $value['image_url']; ?>">
          <?php
        }
        ?>
      </div>

      <label>Sản phẩm làm từ</label>
      <select class="form-select" name="material_id" id="material_id" aria-label="Default select example">
        <?php
        $query1 = mysqli_query($connect, "SELECT * FROM material");
        while ($row = mysqli_fetch_array($query1)) {
          ?>
          <option value="<?php echo $row['material_id'] ?>" <?php echo (($row['material_id'] == $print_value['material_id']) ? 'selected' : ''); ?>><?php echo $row['material_name'] ?>
          </option>
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
          <option value="<?php echo $row['category_id'] ?>" <?php echo (($row['category_id'] == $print_value['category_id']) ? 'selected' : ''); ?>><?php echo $row['category_name'] ?>
          </option>
          <?php
        }
        ?>
      </select>


      <div>
        <button type="submit" name="edit_product" class="success">Sửa</button>
      </div>
  </form>
</body>

</html>
<?php
mysqli_close($connect);
?>