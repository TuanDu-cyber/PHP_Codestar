<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Xử lý request OPTIONS
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

//Kết nối database
// 1. Khai báo biến gọn gàng (Học từ ảnh)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quan_ly_san_pham";

// 2. Khởi tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);

    //Chuyen thanh chuoi json
    echo json_encode([
        "message" => "Kết nối database thất bại"
    ]);

    exit;
}

$conn->set_charset("utf8mb4");

// Lấy phương thức HTTP
$method = $_SERVER["REQUEST_METHOD"];

// Read lấy danh sách sản phẩm: get
if ($method === "GET") {

    $sql = "SELECT id, ten, gia
            FROM san_pham
            ORDER BY id DESC";

    //Thục hien câu lệnh sql ở trên
    $result = $conn->query($sql);

    $sanPhams = [];

    while ($row = $result->fetch_assoc()) {
        $sanPhams[] = $row;
    }

    echo json_encode($sanPhams);

    exit;
}

//Lấy dữ liệu json từ react
$data = json_decode(
    file_get_contents("php://input"),
    true
);

//Create thêm sản phẩm mới: post
if ($method === "POST") {

    $ten = trim($data["ten"] ?? "");
    $gia = $data["gia"] ?? 0;

    if ($ten === "") {

        http_response_code(400);

        echo json_encode([
            "message" => "Tên sản phẩm không được để trống"
        ]);

        exit;
    }

    $sql = "INSERT INTO san_pham (ten, gia)
            VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sd",
        $ten,
        $gia
    );

    $stmt->execute();

    echo json_encode([
        "message" => "Thêm sản phẩm thành công"
    ]);

    exit;
}

//Update cập nhật sản phẩm: put
if ($method === "PUT") {

    $id = $data["id"] ?? 0;
    $ten = trim($data["ten"] ?? "");
    $gia = $data["gia"] ?? 0;

    if ($id <= 0 || $ten === "") {

        http_response_code(400);

        echo json_encode([
            "message" => "Dữ liệu không hợp lệ"
        ]);

        exit;
    }

    $sql = "UPDATE san_pham
            SET ten = ?, gia = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sdsi",
        $ten,
        $gia,
        $moTa,
        $id
    );

    $stmt->execute();

    echo json_encode([
        "message" => "Cập nhật sản phẩm thành công"
    ]);

    exit;
}

//Delete xóa sản phẩm: delete
if ($method === "DELETE") {

    $id = $_GET["id"] ?? 0;

    if ($id <= 0) {

        http_response_code(400);

        echo json_encode([
            "message" => "ID không hợp lệ"
        ]);

        exit;
    }

    $sql = "DELETE FROM san_pham
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    echo json_encode([
        "message" => "Xóa sản phẩm thành công"
    ]);

    exit;
}

// Nếu không phải GET, POST, PUT, DELETE thì trả về lỗi
http_response_code(405);

echo json_encode([
    "message" => "Method không được hỗ trợ"
]);

$conn->close();

?>