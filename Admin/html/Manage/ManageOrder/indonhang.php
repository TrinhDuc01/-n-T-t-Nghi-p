<?php
require('../../../../tfpdf/tfpdf.php');
require "../../../../connect.php";
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    //sql thông tin đơn hàng
    $sql = "SELECT *
      FROM detail_order inner join product on detail_order.product_id=product.product_id 
      WHERE detail_order.order_id = '$order_id'";
    $donhang = mysqli_query($connect, $sql);
    //sql thông tin người nhận
    $sql1 = "SELECT *From order_p Where order_id='$order_id'";
    $thongtinkhachhang = mysqli_query($connect, $sql1);
    $inttkhachhang=mysqli_fetch_array($thongtinkhachhang);
}
else{
    header('location:ReadOrder.php');
}

$pdf = new tFPDF();
$pdf->AddPage("0");
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->Write(10, 'Mã đơn hàng: '.$order_id);
$pdf->Ln(10);
$pdf->Write(10, 'Tên người nhận hàng: '.$inttkhachhang['receiver_name']);
$pdf->Ln(10);
$pdf->Write(10, 'Số điện thoại người nhận hàng: '.$inttkhachhang['receiver_phonenumber']);
$pdf->Ln(10);
$pdf->Write(10, 'Địa chỉ: '.$inttkhachhang['receiver_address']);
$pdf->Ln(10);
$width_cell = array(24, 120, 30, 50, 50);
$pdf->SetFillColor(235, 236, 236);
$pdf->Cell($width_cell[0], 10, 'STT', 1, 0, 'C', true);
$pdf->Cell($width_cell[1], 10, 'Tên sản phẩm', 1, 0, 'C', true);
$pdf->Cell($width_cell[2], 10, 'Số lượng', 1, 0, 'C', true);
$pdf->Cell($width_cell[3], 10, 'Đơn giá', 1, 0, 'C', true);
$pdf->Cell($width_cell[4], 10, 'Thành tiền', 1, 1, 'C', true);
$pdf->SetFillColor(235, 236, 236);
$fill = false;
$i = 0;
$tong_tien = 0;
while ($row = mysqli_fetch_array($donhang)) {
    $i++;
    $pdf->Cell($width_cell[0], 10, $i, 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[1], 10, $row['product_name'], 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[2], 10, $row['order_quantity'], 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[3], 10, number_format($row['product_price']). ' đ', 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[4], 10, number_format($row['product_price'] * $row['order_quantity']). ' đ', 1, 1, 'C', $fill);
    $tong_tien += $row['product_price'] * $row['order_quantity'] ;
    $fill = !$fill;
}
$pdf->Write(10, 'Thành tiền: '. number_format($tong_tien).' đ');
$pdf->Ln(10);
$pdf->Write(20, 'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
$pdf->Ln(10);
$pdf->Output();
?>