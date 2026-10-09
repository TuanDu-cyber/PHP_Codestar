CREATE DATABASE IF NOT EXISTS quanly_sanpham;

USE quanly_sanpham;

CREATE TABLE san_pham (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten VARCHAR(255) NOT NULL,
    gia DECIMAL(12, 2) NOT NULL,
    so_luong INT NOT NULL DEFAULT 0,
    hinh_anh VARCHAR(255) DEFAULT NULL
);

INSERT INTO san_pham (ten, gia, so_luong, hinh_anh)
VALUES
('Trà sữa tiramisu', 50000, 1, 'images/tiramisu.jpg'),
('Trà sữa trân châu đường đen', 70000, 2, 'images/tra_sua.png'),
('Trà sữa thái đỏ', 70000, 2, 'images/thai_do.jpg');

SELECT * FROM san_pham;