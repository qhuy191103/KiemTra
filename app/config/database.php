<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ql_nhansu";
    private $conn;
    private $upload_dir = "public/uploads/";

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
        $this->conn->select_db($this->dbname);

        // Tạo bảng phòng ban
        $sql = "CREATE TABLE IF NOT EXISTS phongban (
            ma_phong VARCHAR(10) PRIMARY KEY,
            ten_phong VARCHAR(50) NOT NULL
        )";
        $this->conn->query($sql);

        // Tạo bảng nhân viên
        $sql = "CREATE TABLE IF NOT EXISTS nhanvien (
            ma_nv VARCHAR(10) PRIMARY KEY,
            ten_nv VARCHAR(100) NOT NULL,
            gioi_tinh VARCHAR(5) NOT NULL,
            noi_sinh VARCHAR(100) NOT NULL,
            ma_phong VARCHAR(10),
            luong VARCHAR(20),
            FOREIGN KEY (ma_phong) REFERENCES phongban(ma_phong)
        )";
        $this->conn->query($sql);

        // Tạo bảng users
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            role VARCHAR(20) NOT NULL DEFAULT 'user'
        )";
        $this->conn->query($sql);

        // Create upload directory if it doesn't exist
        if (!is_dir($this->upload_dir)) {
            if (!@mkdir($this->upload_dir, 0777, true)) {
                die("Không thể tạo thư mục upload: " . error_get_last()['message']);
            }
        }

        $this->insertSamplePhongBan();
        $this->insertSampleNhanVien();
        $this->insertSampleUsers();
    }

    private function insertSamplePhongBan() {
        $check_data = $this->conn->query("SELECT COUNT(*) as total FROM phongban");
        if ($check_data->fetch_assoc()['total'] == 0) {
            $sample_data = [
                ["TC", "Tài Chính"],
                ["KT", "Kỹ Thuật"],
                ["QT", "Quản Trị"]
            ];
            $stmt = $this->conn->prepare("INSERT INTO phongban (ma_phong, ten_phong) VALUES (?, ?)");
            foreach ($sample_data as $data) {
                $stmt->bind_param("ss", $data[0], $data[1]);
                $stmt->execute();
            }
        }
    }

    private function insertSampleNhanVien() {
        $check_data = $this->conn->query("SELECT COUNT(*) as total FROM nhanvien");
        if ($check_data->fetch_assoc()['total'] == 0) {
            $sample_data = [
                ["A01", "Nguyễn thị Hải", "Nữ", "Hà Nội", "TC", "600"],
                ["A02", "Trần văn Chính", "Nam", "Bình Định", "QT", "500"],
                ["A03", "Lê Trần bạch Yến", "Nữ", "TP HCM", "TC", "700"],
                ["A04", "Trần anh Tuấn", "Nam", "Hà Nội", "KT", "800"],
                ["B01", "Trần thanh Mai", "Nữ", "Hải Phòng", "TC", "800"],
                ["B02", "Trần thị thu Thủy", "Nữ", "TP HCM", "KT", "700"],
                ["B03", "Nguyễn Thị Nở", "Nữ", "Ninh Bình", "KT", "400"]
            ];
            $stmt = $this->conn->prepare("INSERT INTO nhanvien (ma_nv, ten_nv, gioi_tinh, noi_sinh, ma_phong, luong) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($sample_data as $data) {
                $stmt->bind_param("ssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
                $stmt->execute();
            }
        }
    }

    private function insertSampleUsers() {
        $check_data = $this->conn->query("SELECT COUNT(*) as total FROM users");
        if ($check_data->fetch_assoc()['total'] == 0) {
            $admin_password = password_hash("admin123", PASSWORD_DEFAULT);
            $user_password = password_hash("user123", PASSWORD_DEFAULT);
            
            $sample_data = [
                ["admin", $admin_password, "Administrator", "admin@example.com", "admin"],
                ["user", $user_password, "User", "user@example.com", "user"]
            ];
            
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, fullname, email, role) VALUES (?, ?, ?, ?, ?)");
            foreach ($sample_data as $data) {
                $stmt->bind_param("sssss", $data[0], $data[1], $data[2], $data[3], $data[4]);
                $stmt->execute();
            }
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getUploadDir() {
        return $this->upload_dir;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>