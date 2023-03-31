<?php
session_start();
require "../../../connect.php";
if(isset($_SESSION['loged'])){
  
}
else{
  header("location:../../LoginAdmin.php");
}
if(isset($_POST['logout'])){
  unset($_SESSION['loged']);
  header("location:../../LoginAdmin.php");
}

if(isset($_REQUEST['edit_id'])){
$id = $_GET['edit_id'];
//câu try vấn nối 4 bảng
$query1 = mysqli_query($connect,"SELECT * FROM product INNER JOIN material ON product.material_id = material.material_id INNER JOIN product_category ON product.category_id = product_category.category_id INNER JOIN room ON product_category.room_id = room.room_id WHERE product_id = '$id'");

$print_value = mysqli_fetch_array($query1); //san pham

// print_r($print_value['product_image']);
// die();

$query_img_mota = mysqli_query($connect,"SELECT * FROM product_image_desc WHERE product_id = '$id'");
}

if(isset($_POST['edit_product'])){
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
  // print_r($_FILES['product_image']);
  // die();
  //kiểm tra ảnh
  if(isset($_FILES['product_image'])){
    $file = $_FILES['product_image'];
    $product_image = $file['name'];
    // echo 'empty($product_image)';
    // die();
    //truong hop nguoi dung khong chon anh
    if(empty($product_image)){
      $product_image = $print_value['product_image'];
    }
    //truong hop nguoi dung chon anh
    else{
      if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png'){
      move_uploaded_file($file['tmp_name'], '../../imgAdmin/'.$product_image);
    }
    else{
      $error['product_image'] = "Không đúng định dạng";
    }
    }
    
  }
  $product_status = $_POST['product_status'];
  $updated_at = date('Y-m-d H:i:s');
  //kiểm tra
  if (empty($product_name)) {
        $error['product_name'] = "Tên sản phẩm không được để trống";
  }
  //kiểm tra
  if(empty($product_quantity)){
    $error['product_quantity'] = "Số lượng sản phẩm không được để trống";
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
//Sửa sản phẩm
  if(empty($error['product_image']) && empty($error['product_name']) && empty($error['product_quantity']) && empty($error['product_price']) && empty($error['product_decription'])){
    $sqlInsert = "UPDATE product SET product_name='$product_name', product_price='$product_price', product_decription='$product_decription', product_quantity='$product_quantity', product_size='$product_size', product_image='$product_image', product_status='$product_status', material_id='$material_id', category_id='$category_id',updated_at='$updated_at' WHERE product_id = '$id'";
    $query = mysqli_query($connect,$sqlInsert);
    $id_product_after_insert = mysqli_insert_id($connect);
  }

//Sửa nhiều ảnh

  

  if(isset($_FILES['product_images'])){
    $files = $_FILES['product_images'];
    $image_urls = $files['name'];

    if(!empty($image_urls[0])){
      mysqli_query($connect,"DELETE FROM product_image_desc WHERE product_id='$id'");
      foreach ($image_urls as $key => $value) {
      if(empty($files['name'][$key])){
        break;
      }
      else{
        move_uploaded_file($files['tmp_name'][$key], '../../imgAdmin/'.$value);
        mysqli_query($connect,"INSERT INTO product_image_desc(image_url,product_id,updated_at) VALUES ('$value','$id','$updated_at')");
        
      }
    }
    }
      
  }
  if($query){
    header('location:CreateReadDeleteProduct.php');
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
<div class="row">
  <div class="col-4"></div>
  <div class="col-4">
  <form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Sửa sản phẩm</legend>
    <div class="mb-3">
      <label for="product_name" class="form-label">Tên sản phẩm</label>
      <input type="text" value="<?php echo $print_value['product_name'] ?>" name="product_name" id="product_name" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_name']) ? $error['product_name']:''; ?> </div>

      <label for="product_price"  class="form-label">Giá sản phẩm</label>
      <input type="text" value="<?php echo $print_value['product_price'] ?>" name="product_price" id="product_price" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_price']) ? $error['product_price']:''; ?> </div>

      <label for="product_decription" class="form-label">Mô tả sản phẩm</label>
      <input type="text" value="<?php echo $print_value['product_decription'] ?>" name="product_decription" id="product_decription" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_decription']) ? $error['product_decription']:''; ?> </div>

      <label for="product_quantity" class="form-label">Số lượng sản phẩm</label>
      <input type="text" value="<?php echo $print_value['product_quantity'] ?>" name="product_quantity" id="product_quantity" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_quantity']) ? $error['product_quantity']:''; ?> </div>

      <label for="product_size" class="form-label">Kích thước sản phẩm</label>
      <input type="text" value="<?php echo $print_value['product_size'] ?>" name="product_size" id="product_size" class="form-control" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_size']) ? $error['product_size']:''; ?> </div>

      <label for="product_image" class="form-label">Ảnh sản phẩm</label>
      <input type="file"  name="product_image" id="product_image" class="form-control" placeholder="Nhập...">
      <img class="form-control"  src="<?php echo '../../imgAdmin/'.$print_value['product_image'] ?>">
      <div class="text-danger"> <?php echo isset($error['product_image']) ? $error['product_image']:''; ?> </div>



      <div class="form-group">

        <label for="product_images" class="form-label">Ảnh mô tả sản phẩm</label>
      <input type="file" name="product_images[]" id="product_images" class="form-control" multiple="mutiple" placeholder="Nhập...">
      <div class="text-danger"> <?php echo isset($error['product_images']) ? $error['product_images']:''; ?> </div>

      <div class="row">
        <?php  
        foreach ($query_img_mota as $key => $value) {
          ?>
          <div class="col-md-6">
              <img style="max-width: 250px;" class="thumbnail" src="<?php echo '../../imgAdmin/'.$value['image_url']; ?>">
          </div>

      <?php
        }
      ?>
      </div>
      </div>

      <label for="material_id" class="form-label">Sản phẩm làm từ</label>
      <select class="form-select" name="material_id" id="material_id" aria-label="Default select example">
        <?php 
          $query1 = mysqli_query($connect,"SELECT * FROM material");
          while ($row = mysqli_fetch_array($query1)) {
            ?>
            <option value="<?php echo $row['material_id']?>" <?php echo (($row['material_id']==$print_value['material_id'])?'selected':''); ?>><?php echo $row['material_name'] ?></option>
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
        <option value="<?php echo $row['category_id']?>" <?php echo (($row['category_id']==$print_value['category_id'])?'selected':''); ?>><?php echo $row['category_name'] ?></option>
        <?php
        }
        ?>
      </select>



      <label for="flexRadioDefault" class="form-label">Trạng thái</label>
      <div class="form-check form-switch">
      <input value="1" class="form-check-input" type="radio" name="product_status" id="flexRadioDefault1" <?php echo (($print_value['product_status']==1)?'checked':'');?>>
      <label class="form-check-label" for="flexRadioDefault1">
        Kích hoạt
        </label>
      </div>
      <div class="form-check form-switch">
        <input value="0" class="form-check-input" type="radio" name="product_status" id="flexRadioDefault2" <?php echo (($print_value['product_status']==0)?'checked':'');?>>
        <label class="form-check-label" for="flexRadioDefault2">
          Không kích hoạt
        </label>
</div>
</div>
    </div>
    <div class="text-center">
      <button type="submit" name="edit_product" class="btn btn-primary">Sửa</button>
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