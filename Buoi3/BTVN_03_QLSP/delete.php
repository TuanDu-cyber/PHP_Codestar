<?php
include "db.php";
require_once "image_helper.php";

//Kiểm tra phương thức request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Phương thức không hợp lệ.");
}

//Lấy ID sản phẩm từ dữ liệu POST
$id = filter_input(
    INPUT_POST,
    "id",
    
    //Kiểm tra dữ liệu có phải số nguyên 
    FILTER_VALIDATE_INT
);

//Kiểm tra ID sản phẩm hợp lệ ko
if (!$id || $id < 1) {
    die("ID sản phẩm không hợp lệ.");
}

//Lấy hình tảnh theo id
$stmt = $conn->prepare(
    "SELECT hinh_anh FROM san_pham WHERE id = ?"
);

// Gắn ID vào dấu ? dưới dạng số nguyên (i)
$stmt->bind_param("i", $id);

//Thực hiẹn select
$stmt->execute();

$result = $stmt->get_result();

//Lấy 1 dòng dữ liệu từ kết quả truy vấn
$product = $result->fetch_assoc();

//Kiểm tra xem sản phẩm có tồn tại hay không
if (!$product) {
    die("Không tìm thấy sản phẩm.");
}

//Xóa sản phẩm khỏi database
$sql = "DELETE FROM san_pham WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

//xóa  sản phẩm 
if ($stmt->execute()) {

    xoaHinhAnh($product["hinh_anh"]);

    header("Location: index.php");
    exit;

} else {

    echo "Không thể xóa sản phẩm.";
}
?>