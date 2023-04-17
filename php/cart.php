<?php
session_start();
require "../connect.php";

$_SESSION['error']['overload']='';
$_SESSION['login']['customer_id'];
if(isset($_SESSION['login'])){
    //kiểm tra có gửi được id product qua không
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //kiem tra sp có trong database không
        $query = mysqli_query($connect,"SELECT * FROM product WHERE product_id = '$id'");
        $id_customer=$_SESSION['login']['customer_id'];
        if($query){
            $product = mysqli_fetch_assoc($query);
        }
        
        $item = [
            'id' => $product['product_id'],
            'name'=> $product['product_name'],
            'image' => $product['product_image'],
            'price' => $product['product_price'],
            'quantity'=> 1
        ];
        //them vao gio hang
        if($product['product_quantity']>0){
        if(isset($_SESSION['cart'][$id_customer][$id])){
            //nếu số lượng sản phẩm trong database > số lượng sản phẩm trong giỏ hàng thì mới cho thêm]
            if($_SESSION['cart'][$id_customer][$id]['quantity']<$product['product_quantity']){
                $_SESSION['cart'][$id_customer][$id]['quantity'] += 1;
                // echo 'ok';
            }
            else{
                $_SESSION['error']['overload'] = 'Số lượng sản phẩm không đủ để thêm vào giỏ hàng';
            }
        }
        else{
            $_SESSION['cart'][$id_customer][$id] = $item;
        
        }
        }
        else{
            $_SESSION['error']['overload'] = 'Số lượng sản phẩm không đủ';
        } 
        
        
        echo '<pre>';
        print_r($_SESSION['cart']);
        //cap nhat gio hang
        //xoa san phamkhoi gio hang
        
        header('location:../viewCart.php');
        // unset($_SESSION['cart']);
        
    }
    else{
        header('location:../index.php');
    }
}
else{
    header('location:../index.php');
}





?>

<?php
mysqli_close($connect);
?>