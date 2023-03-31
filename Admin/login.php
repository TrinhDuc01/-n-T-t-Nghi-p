<?php
session_start();
require "../connect.php";
if(isset($_POST['login'])){
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $checklogin = mysqli_query($connect,"SELECT * FROM admin WHERE admin_account='$name' AND admin_password = '$password'");
    $count = mysqli_num_rows($checklogin);
	if($count==1){
		$_SESSION["admin_login"] = true;
		header("location:html/indexAdmin.php");
	}
	else{
		header("location:html/loginAdmin.php");
	}
}
?>