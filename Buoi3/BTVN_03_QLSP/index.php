<?php
include "db.php";

//Khai báo sql lấy danh sách sản phẩm giảm dần
$sql = "SELECT * FROM san_pham ORDER BY id DESC";

//Thục hiện câu lệnh sql ở trên
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý sản phẩm</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background: #f4f6f9;
    }

    h2 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background: #087f8c;
        color: white;
    }

    .btn {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }

    .add {
        background: #198754;
    }

    .edit {
        background: #0d6efd;
    }

    .delete {
        background: #dc3545;
    }

    .product-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
    }

    .actions {
        white-space: nowrap;
    }
    </style>
</head>

<body>

    <h2>QUẢN LÝ SẢN PHẨM</h2>

    <a href="create.php" class="btn add">
        + Thêm sản phẩm
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>
                <td>
                    <?php echo $row['id'] ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['ten']) ?>
                </td>

                <td>
                    <?php echo number_format(
                            $row['gia'],
                            0,
                            ',',
                            '.'
                        ) ?> VNĐ
                </td>

                <td>
                    <?php echo $row['so_luong'] ?>
                </td>

                <td>
                    <?php
                    
                    //Kiểm tra xem có ảnh hay không, nếu có thì hiển thị ảnh, nếu không thì hiển thị "Chưa có ảnh"
                     if (!empty($row['hinh_anh'])) { ?>

                    <!-- Nếu có ảnh -->
                    <img class="product-image" src="<?php echo htmlspecialchars($row['hinh_anh']) ?>"
                        alt="Ảnh sản phẩm">

                    <?php } else { ?>

                    Chưa có ảnh

                    <?php } ?>
                </td>

                <td class="actions">

                    <a class="btn edit" href="edit.php?id=<?php echo $row['id'] ?>">
                        Sửa
                    </a>

                    <form action="delete.php" method="POST" style="display:inline;"
                        onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                        <button type="submit" class="btn delete">
                            Xóa
                        </button>
                    </form>

                </td>
            </tr>

            <?php } ?>

        </tbody>
    </table>

</body>

</html>