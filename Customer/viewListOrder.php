<?php
session_start();
require "../connect.php";
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header('location:login.php');
}

$id_user = $user['customer_id'];
// print_r($id_user);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đặt hàng</title>
    <link rel="stylesheet" type="text/css" href="./css/style_user.css">
    <link href="../icon/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../Admin/css/pagination.css">
</head>

<body>
    <?php // phan trang
    $queryRows = mysqli_query($connect, "SELECT * FROM `order_p` Where customer_id = '$id_user'");
    $totalRows = mysqli_num_rows($queryRows);
    $pageSize = 8; // số dòng tối đa trong 1 trang
    $totalPage = 1; // tính  tổng số trang
    
    // print_r($tencot);
    
    if ($totalRows % $pageSize == 0) {
        $totalPage = $totalRows / $pageSize;
    } else {
        $totalPage = (int) ($totalRows / $pageSize) + 1;
    }

    $rowStart = 1;
    $pageCurrent = 1;

    if ((!isset($_GET['page'])) || ($_GET['page'] == 1)) {
        $rowStart = 0;
        $pageCurrent = 1;
    } else {
        $rowStart = ($_GET['page'] - 1) * $pageSize;
        $pageCurrent = $_GET['page'];
    }

    ?>
    <div class="header">
        <a href="../index.php"><i class="fa-sharp fa-solid fa-house"></i> Xin Chào
            <?php echo $user['customer_fullname']; ?>
        </a>
    </div>
    <div class="container-f">
        <ul>
            <li><a href="./customerInfo.php">Thông tin</a></li>
            <li><a href="./viewListOrder.php">Đơn hàng</a></li>
            <li><a href="./changePasswordUser.php">Đổi mật khẩu</a></li>
            <li><a href="./changeInfo.php">Đổi thông tin</a></li>
        </ul>
        <div class="view-info">

            <table>
                <tr>
                    <td>Mã đơn hàng</td>
                    <td>Tên người nhận</td>
                    <td>Số điện thoại</td>
                    <td>Địa chỉ nhận hàng</td>
                    <td>Trạng thái</td>
                    <td>Ngày đặt</td>
                    <td>Xem chi tiết</td>
                </tr>
                <?php
                $sql = "SELECT * FROM order_p   WHERE order_p.customer_id='$id_user' ORDER BY order_p.order_id DESC limit {$rowStart} , {$pageSize}";
                $donhang = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($donhang)) {
                    ?>

                    <tr style="<?php echo $row['order_status'] == 4 ? 'opacity:0.5;' : '' ?>">
                        <td>
                            <?php echo $row['order_id'] ?>
                        </td>
                        <td>
                            <?php echo $row['receiver_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['receiver_phonenumber'] ?>
                        </td>
                        <td>
                            <?php echo $row['receiver_address'] ?>
                        </td>
                        <td>
                            <?php
                            if ($row['order_status'] == 0) {
                                echo '<button class="NO">Chưa duyệt</button>';
                            } else if ($row['order_status'] == 1) {
                                echo '<button class="NO">Đã duyệt</button>';
                            } else if ($row['order_status'] == 2) {
                                echo '<button class="NO">Đang giao</button>';
                            } else
                                echo '<button class="NO">Bạn đã huỷ đơn</button>';
                            ?>
                        </td>
                        <td>
                            <?php echo $row['created_at'] ?>
                        </td>
                        <td>
                            <a href="./ViewDetailOrder.php?<?php echo 'order_id=' . $row['order_id']; ?>" class="detail">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div style="margin:0 0 50px 50px">
                Trang:
                <?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : 1 ?>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($pageCurrent == $i) {
                            echo "<a>" . $i . "</a>";
                        } else {
                            ?>
                            <a href="?page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($connect);
?>