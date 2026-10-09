<?php
include "db.php";
require_once "image_helper.php";

//Khởi tạo biến lưu thông báo lỗi
$error = "";

//Kiểm tra user đã submit form hay chưa
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //Lấy tên sp loại bỏ khoảng trắng nếu k có mặc định rỗng
    $ten = trim($_POST["ten"] ?? "");

    $gia = $_POST["gia"] ?? "";
    $so_luong = $_POST["so_luong"] ?? "";

    //Kiểm tra dữ liệu hợp lệ
    if (
        $ten === "" ||
        !is_numeric($gia) ||//Kiểm tra giá có phải là số hay không
        $gia < 0 ||
        filter_var(
            $so_luong,
            FILTER_VALIDATE_INT
        ) === false ||
        $so_luong < 0
    ) {
        //Nếu sai thông báo lõi
        $error = "Vui lòng nhập thông tin hợp lệ.";
    } else {
        
        //Khởi tạo biến lưu đường dẫn ảnh
        $hinh_anh = null;

        try {
            //Ko có ảnh truyền null
            $hinh_anh = uploadHinhAnh(
                $_FILES["hinh_anh"] ?? null
            );

            //Thêm sản phẩm vào database 
            $sql = "INSERT INTO san_pham
                    (ten, gia, so_luong, hinh_anh)
                    VALUES (?, ?, ?, ?)";

            //Chuẩn bị câu lệnh SQL
            $stmt = $conn->prepare($sql);
            
            //Gắn giá trị vào các dấu ?; s=string, d=double, i=integer, b=blob
            $stmt->bind_param(
                "sdis",
                $ten,
                $gia,
                $so_luong,
                $hinh_anh
            );

            //Thực thi câu lệnh SQL
            if ($stmt->execute()) {
                //Thêm thành công chuyển về index và thoát
                header("Location: index.php");
                exit;
            }
            
            //Thêm tbai thì xóa
            xoaHinhAnh($hinh_anh);

            $error = "Không thể thêm sản phẩm.";

        } catch (Throwable $e) {
            //Nếu có lỗi thì xóa ảnh đã upload
            xoaHinhAnh($hinh_anh);

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

    <title>Thêm sản phẩm</title>

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
        background: #57e4a2;
    }

    .back {
        background: #bcc8d3;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>

    <h2>THÊM SẢN PHẨM</h2>

    <?php if ($error !== "") { ?>
    <p class="error">
        <?php echo htmlspecialchars($error) ?>
    </p>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <p>
            Tên sản phẩm:
            <input type="text" name="ten" required>
        </p>

        <p>
            Giá:
            <input type="number" name="gia" min="0" step="0.01" required>
        </p>

        <p>
            Số lượng:
            <input type="number" name="so_luong" min="0" step="1" required>
        </p>

        <p>
            Hình ảnh:
            <input type="file" name="hinh_anh" accept="image/jpeg,image/png,image/webp">
        </p>

        <button type="submit" class="btn save">
            Thêm sản phẩm
        </button>

        <a href="index.php" class="btn back">
            Quay lại
        </a>

    </form>

</body>

</html>