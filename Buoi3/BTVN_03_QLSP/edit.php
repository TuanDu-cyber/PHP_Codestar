<?php
include "db.php";
require_once "image_helper.php";

//lấy id sp
$id = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);

//Kiểm tra ID sản phẩm hợp lệ ko
if (!$id || $id < 1) {
    die("ID sản phẩm không hợp lệ.");
}

//Lấy thông tin sản phẩm từ database
$stmt = $conn->prepare(
    "SELECT * FROM san_pham WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Không tìm thấy sản phẩm.");
}

//Khởi tạo biến thông báo lỗi
$error = "";

//Kiểm tra user đã submit form hay chưa
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $ten = trim($_POST["ten"] ?? "");
    $gia = $_POST["gia"] ?? "";
    $so_luong = $_POST["so_luong"] ?? "";

    //Kiểm tra dữ liệu hợp lệ
    if (
        $ten === "" ||
        !is_numeric($gia) ||
        $gia < 0 ||
        filter_var(
            $so_luong,
            FILTER_VALIDATE_INT
        ) === false ||
        $so_luong < 0
    ) {
        $error = "Vui lòng nhập thông tin hợp lệ.";
    } else {
        
        //Khởi tạo biến lưu đường dẫn ảnh mới
        $anhMoi = null;

        try {
            $anhMoi = uploadHinhAnh(
                $_FILES["hinh_anh"] ?? null
            );

            $hinh_anh = $anhMoi ?? $product["hinh_anh"];

            $sql = "UPDATE san_pham
                    SET ten = ?,
                        gia = ?,
                        so_luong = ?,
                        hinh_anh = ?
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);

            //Gắn giá trị vào các dấu ?; s=string, d=double, i=integer, b=blob
            $stmt->bind_param(
                "sdisi",
                $ten,
                $gia,
                $so_luong,
                $hinh_anh,
                $id
            );

            //Thực thi 
            if ($stmt->execute()) {

                if ($anhMoi !== null) {
                    xoaHinhAnh($product["hinh_anh"]);
                }

                header("Location: index.php");
                exit;

            } else {

                xoaHinhAnh($anhMoi);

                $error = "Không thể cập nhật sản phẩm.";
            }

        } catch (Throwable $e) {

            xoaHinhAnh($anhMoi);

            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa sản phẩm</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background: #f4f6f9;
    }

    form {
        max-width: 500px;
        background: white;
        padding: 20px;
        border-radius: 8px;
    }

    input {
        box-sizing: border-box;
        width: 100%;
        padding: 10px;
        margin-top: 8px;
    }

    .current-image {
        width: 150px;
        height: auto;
        display: block;
        margin-top: 10px;
    }

    .btn {
        display: inline-block;
        padding: 10px 14px;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
    }

    .save {
        background: #0d6efd;
    }

    .back {
        background: #6c757d;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>

    <h2>SỬA SẢN PHẨM</h2>

    <?php if ($error !== "") { ?>
    <p class="error">
        <?= htmlspecialchars($error) ?>
    </p>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <p>
            Tên sản phẩm:
            <input type="text" name="ten" required value="<?= htmlspecialchars($product['ten']) ?>">
        </p>

        <p>
            Giá:
            <input type="number" name="gia" min="0" step="0.01" required
                value="<?= htmlspecialchars($product['gia']) ?>">
        </p>

        <p>
            Số lượng:
            <input type="number" name="so_luong" min="0" step="1" required
                value="<?= htmlspecialchars($product['so_luong']) ?>">
        </p>

        <p>Ảnh hiện tại:</p>

        <?php if (!empty($product['hinh_anh'])) { ?>

        <img class="current-image" src="<?= htmlspecialchars($product['hinh_anh']) ?>" alt="Ảnh sản phẩm">

        <?php } else { ?>

        <p>Chưa có ảnh</p>

        <?php } ?>

        <p>
            Chọn ảnh mới:
            <input type="file" name="hinh_anh" accept="image/jpeg,image/png,image/webp">
        </p>

        <button type="submit" class="btn save">
            Lưu thay đổi
        </button>

        <a href="index.php" class="btn back">
            Quay lại
        </a>

    </form>

</body>

</html>