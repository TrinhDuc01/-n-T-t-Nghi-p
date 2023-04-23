<?php
session_start();
require "connect.php";

if (isset($_SESSION['login'])) {
        if (isset($_POST['order'])) {
            $receiver_name = $_POST['fullname'];
            $receiver_phone_number = $_POST['phone_number'];
            $receiver_address = $_POST['address'];
            //check data
            echo '<pre>';
            print_r($_SESSION['cart']);
            $created_at = date('Y-m-d H:i:s');
            $updated_at = NULL;
            $id_customer = $_SESSION['login']['customer_id'];
            $donhang = $_SESSION['cart'][$id_customer];
            foreach ($donhang as $key => $value) {
                //check data
                echo '<pre>';
                print_r($value);
                $product_id = $value['id'];
                $order_quantity = $value['quantity'];
                //Thêm đơn hàng
                $sql_addOrder = "INSERT INTO order_p(product_id,customer_id,receiver_name,receiver_phonenumber,receiver_address,order_quantity,order_status,order_status_customer,created_at,updated_at) 
            VALUES('$product_id','$id_customer','$receiver_name','$receiver_phone_number','$receiver_address','$order_quantity',0,1,'$created_at','$updated_at')";
                mysqli_query($connect, $sql_addOrder);
                //giảm số lượng hàng ở bảng product sau khi thêm đơn hàng
                $sql_decrease_quantity = "UPDATE product SET product_quantity=product_quantity - '$order_quantity' WHERE product_id='$product_id'";
                mysqli_query($connect, $sql_decrease_quantity);
            }
            unset($_SESSION['cart'][$id_customer]);
            header('location:./Customer/viewListOrder.php');

        }

} else {
    header('location:index.php');
}




?>