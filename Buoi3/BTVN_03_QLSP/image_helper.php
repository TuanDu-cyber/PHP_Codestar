<?php

//Hàm upload hình ảnh
function uploadHinhAnh($file)
{
    //Kiểm tra nếu upload ảnh bị lỗi thì trả về null
    if ($file['error'] != 0) {
        return null;
    }

    //Đặt tên cho ảnh
    $tenFile = time() . "_" . $file['name'];

    //Đường dẫn lưu ảnh
    $duongDan = "images/" . $tenFile;

    //Di chuyển ảnh từ thư mục tạm sang thư mục lưu ảnh
    move_uploaded_file($file['tmp_name'], __DIR__ . "/" . $duongDan);

    return $duongDan;
}

//Hàm xóa anh
function xoaHinhAnh($duongDan)
{
    //Lấy đường dẫn của ảnh
    $file = __DIR__ . "/" . $duongDan;

    //Kiểm tra nếu file tồn tại thì xóa
    if (file_exists($file)) {
        unlink($file);
    }
}