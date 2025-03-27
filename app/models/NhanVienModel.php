<?php
require_once 'app/config/database.php';

class NhanVienModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getAllNhanVien() {
        return $this->conn->query("SELECT nv.*, pb.ten_phong 
                                   FROM nhanvien nv 
                                   LEFT JOIN phongban pb ON nv.ma_phong = pb.ma_phong");
    }

    public function addNhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong) {
        $stmt = $this->conn->prepare("INSERT INTO nhanvien (ma_nv, ten_nv, gioi_tinh, noi_sinh, ma_phong, luong) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong);
        return $stmt->execute();
    }

    public function getNhanVienById($ma_nv) {
        $stmt = $this->conn->prepare("SELECT nv.*, pb.ten_phong 
                                      FROM nhanvien nv 
                                      LEFT JOIN phongban pb ON nv.ma_phong = pb.ma_phong 
                                      WHERE nv.ma_nv = ?");
        $stmt->bind_param("s", $ma_nv);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateNhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong) {
        $stmt = $this->conn->prepare("UPDATE nhanvien SET ten_nv = ?, gioi_tinh = ?, noi_sinh = ?, ma_phong = ?, luong = ? WHERE ma_nv = ?");
        $stmt->bind_param("ssssss", $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong, $ma_nv);
        return $stmt->execute();
    }

    public function deleteNhanVien($ma_nv) {
        $stmt = $this->conn->prepare("DELETE FROM nhanvien WHERE ma_nv = ?");
        $stmt->bind_param("s", $ma_nv);
        return $stmt->execute();
    }

    public function getAllWithPagination($page = 1, $limit = 5) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT nv.*, pb.ten_phong 
                FROM nhanvien nv 
                LEFT JOIN phongban pb ON nv.ma_phong = pb.ma_phong 
                ORDER BY nv.ma_nv 
                LIMIT ? OFFSET ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalRecords() {
        $sql = "SELECT COUNT(*) as total FROM nhanvien";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?> 