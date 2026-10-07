import { useEffect, useState } from "react";
import "./App.css";

const API_URL = "http://localhost/HocPHP_codestar/Buoi3/BTVN/frontend/api.php";

function App() {
  const [sanPhams, setSanPhams] = useState([]);
  const [ten, setTen] = useState("");
  const [gia, setGia] = useState("");
  const [dangSuaId, setDangSuaId] = useState(null);

  // Lấy danh sách sản phẩm
  const laySanPhams = async () => {
    const response = await fetch(API_URL);
    const data = await response.json();
    setSanPhams(data);
  };

  // Gọi 1 lần khi load trang
  useEffect(() => {
    const fetchSanPhams = async () => {
      try {
        const response = await fetch(API_URL);
        const data = await response.json();

        setSanPhams(data);
      } catch {
        alert("Không thể kết nối tới PHP");
      }
    };

    fetchSanPhams();
  }, []);

  // Đặt lại form
  const resetForm = () => {
    setTen("");
    setGia("");
    setDangSuaId(null);
  };

  // Thêm / Sửa sản phẩm
  const xuLySubmit = async (e) => {
    e.preventDefault();

    const sanPham = {
      ten: ten.trim(),
      gia: Number(gia),
    };

    if (dangSuaId === null) {
      // Thêm
      await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },

        //Chuyen sang chuoi Json
        body: JSON.stringify(sanPham),
      });
    } else {
      // Sửa
      await fetch(API_URL, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },

        //Chuyen sang chuoi Json, co toan tu spread operator
        body: JSON.stringify({ id: dangSuaId, ...sanPham }),
      });
    }

    // Cập nhật lại giao diện và xóa trắng form
    await laySanPhams();
    resetForm();
  };

  // Đưa dữ liệu lên form để sửa
  const suaSanPham = (sanPham) => {
    setDangSuaId(sanPham.id);
    setTen(sanPham.ten);
    setGia(sanPham.gia);
  };

  // Xóa sản phẩm
  const xoaSanPham = async (id) => {
    await fetch(`${API_URL}?id=${id}`, {
      method: "DELETE",
    });

    // Cập nhật lại giao diện
    await laySanPhams();
  };

  return (
    <div className="container">
      <h1>Quản lý sản phẩm</h1>

      <form onSubmit={xuLySubmit}>
        <div className="form-group">
          <label>Tên sản phẩm</label>
          <input
            type="text"
            placeholder="Nhập tên sản phẩm..."
            value={ten}
            onChange={(e) => setTen(e.target.value)}
          />
        </div>

        <div className="form-group">
          <label>Giá</label>
          <input
            type="number"
            placeholder="Nhập giá..."
            value={gia}
            onChange={(e) => setGia(e.target.value)}
          />
        </div>

        <div className="buttons">
          <button type="submit">
            {dangSuaId === null ? "Thêm sản phẩm" : "Cập nhật sản phẩm"}
          </button>

          {dangSuaId !== null && (
            <button type="button" onClick={resetForm}>
              Hủy sửa
            </button>
          )}
        </div>
      </form>

      <h2>Danh sách sản phẩm</h2>
      <p>
        Tổng số sản phẩm: <b>{sanPhams.length}</b>
      </p>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Thao tác</th>
          </tr>
        </thead>

        <tbody>
          {sanPhams.length === 0 ? (
            <tr>
              <td colSpan="4">Chưa có sản phẩm</td>
            </tr>
          ) : (
            sanPhams.map((sanPham) => (
              <tr key={sanPham.id}>
                <td>{sanPham.id}</td>
                <td>{sanPham.ten}</td>
                <td>{Number(sanPham.gia).toLocaleString("vi-VN")} VNĐ</td>
                <td>
                  <button
                    className="btn-sua"
                    onClick={() => suaSanPham(sanPham)}
                  >
                    Sửa
                  </button>
                  <button
                    className="btn-xoa"
                    onClick={() => xoaSanPham(sanPham.id)}
                  >
                    Xóa
                  </button>
                </td>
              </tr>
            ))
          )}
        </tbody>
      </table>
    </div>
  );
}

export default App;
