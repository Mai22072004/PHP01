<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//CSDL 
/*CREATE DATABASE QuanLySinhVien;
USE QuanLySinhVien;

CREATE TABLE LopHoc (
  MaLop INT PRIMARY KEY AUTO_INCREMENT,
  TenLop VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE MonHoc (
  MaMon INT PRIMARY KEY AUTO_INCREMENT,
  TenMon VARCHAR(100) NOT NULL
);

CREATE TABLE SinhVien (
  MaSV INT PRIMARY KEY AUTO_INCREMENT,
  HoTen VARCHAR(100) NOT NULL,
  NgaySinh DATE,
  GioiTinh ENUM('Nam', 'Nữ'),
  MaLop INT,
  FOREIGN KEY (MaLop) REFERENCES LopHoc(MaLop)
);

CREATE TABLE Diem (
  MaDiem INT PRIMARY KEY AUTO_INCREMENT,
  MaSV INT,
  MaMon INT,
  DiemSo FLOAT,
  HocKy INT,
  NamHoc YEAR,
  FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
  FOREIGN KEY (MaMon) REFERENCES MonHoc(MaMon)
);
INSERT INTO LopHoc (TenLop) VALUES
  ('10A1'),
  ('10A2'),
  ('11A1');
  
  INSERT INTO MonHoc (TenMon) VALUES
  ('Toán'),
  ('Lý'),
  ('Hóa'),
  ('Ngữ văn');
 INSERT INTO SinhVien (HoTen, NgaySinh, GioiTinh, MaLop) VALUES
  ('Nguyễn Văn A', '2000-01-01', 'Nam', 1),
  ('Trần Thị B', '2001-05-15', 'Nữ', 2),
  ('Lê Văn C', '2002-12-25', 'Nam', 1);
  
  INSERT INTO Diem (MaSV, MaMon, DiemSo, HocKy, NamHoc) VALUES
  (1, 1, 8, 1, 2024),
  (1, 2, 7, 1, 2024),
  (2, 1, 9, 1, 2024),
  (2, 3, 6, 1, 2024);*/
//SLIDE 6
// Thông tin kết nối cơ sở dữ liệu XAMPP
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "QuanLySinhVien";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thêm một sinh viên mới
$sql = "INSERT INTO SinhVien (HoTen, NgaySinh, GioiTinh, MaLop) 
        VALUES ('Nguyễn Thị D', '2003-09-12', 'Nữ', 1)";
if ($conn->query($sql) === TRUE) {
    echo "Thêm sinh viên thành công";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cập nhật điểm của sinh viên có mã số 1 môn Toán lên 9
$sql = "UPDATE Diem SET DiemSo = 9 WHERE MaSV = 1 AND MaMon = 1";
if ($conn->query($sql) === TRUE) {
    echo "Cập nhật điểm thành công";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Xóa một sinh viên có mã số 3
$sql = "DELETE FROM SinhVien WHERE MaSV = 3";
if ($conn->query($sql) === TRUE) {
    echo "Xóa sinh viên thành công";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Lấy danh sách tất cả sinh viên và hiển thị
$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Mã SV</th><th>Họ tên</th><th>Ngày sinh</th><th>Giới tính</th><th>Mã lớp</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["MaSV"]. "</td><td>" . $row["HoTen"]. "</td><td>" . $row["NgaySinh"]. "</td><td>" . $row["GioiTinh"]. "</td><td>" . $row["MaLop"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "Không có sinh viên nào";
}

$conn->close();


//SILDE 14

// Thông tin kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "QuanLySinhVien";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công";
} catch(PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage(); 
    exit();
}

// Thêm một sinh viên mới
function themSinhVien($hoten, $ngaysinh, $gioitinh, $malop) {
    global $conn;
    $sql = "INSERT INTO SinhVien (HoTen, NgaySinh, GioiTinh, MaLop) 
            VALUES (:hoten, :ngaysinh, :gioitinh, :malop)";$stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoten', $hoten);
    $stmt->bindParam(':ngaysinh', $ngaysinh);
    $stmt->bindParam(':gioitinh', $gioitinh);
    $stmt->bindParam(':malop', $malop);
    $stmt->execute();
}

// Cập nhật thông tin sinh viên
function capNhatSinhVien($masv, $hoten, $ngaysinh, $gioitinh, $malop) {
    global $conn;
    $sql = "UPDATE SinhVien SET HoTen = :hoten, NgaySinh = :ngaysinh, GioiTinh = :gioitinh, MaLop = :malop WHERE MaSV = :masv";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoten', $hoten);
    $stmt->bindParam(':ngaysinh', $ngaysinh);
    $stmt->bindParam(':gioitinh', $gioitinh);
    $stmt->bindParam(':malop', $malop);
    $stmt->bindParam(':masv', $masv);
    $stmt->execute();
}

// Xóa sinh viên
function xoaSinhVien($masv) {
    global $conn;
    $sql = "DELETE FROM SinhVien WHERE MaSV = :masv";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':masv', $masv);
    $stmt->execute();
}

// Hiển thị danh sách sinh viên
function hienThiSinhVien() {
    global $conn;
    $sql = "SELECT * FROM SinhVien";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    echo "<table><tr><th>Mã SV</th><th>Họ tên</th><th>Ngày sinh</th><th>Giới tính</th><th>Mã lớp</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["MaSV"]. "</td><td>" . $row["HoTen"]. "</td><td>" . $row["NgaySinh"]. "</td><td>" . $row["GioiTinh"]. "</td><td>" . $row["MaLop"]. "</td></tr>";
    }
    echo "</table>";
}

// Ví dụ sử dụng các hàm
themSinhVien("Nguyễn Văn B", "2002-11-22", "Nam", 2);
capNhatSinhVien(1, "Nguyễn Thị A", "2000-01-01", "Nữ", 1);
xoaSinhVien(3);
hienThiSinhVien();

$conn = null;
?>
</body>
</html>

