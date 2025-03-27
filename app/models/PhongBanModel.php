<?php
require_once 'app/config/database.php';

class PhongBanModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getAllPhongBan() {
        return $this->conn->query("SELECT * FROM phongban");
    }

    public function addPhongBan($ma_phong, $ten_phong) {
        $stmt = $this->conn->prepare("INSERT INTO phongban (ma_phong, ten_phong) VALUES (?, ?)");
        $stmt->bind_param("ss", $ma_phong, $ten_phong);
        return $stmt->execute();
    }

    public function getPhongBanById($ma_phong) {
        $stmt = $this->conn->prepare("SELECT * FROM phongban WHERE ma_phong = ?");
        $stmt->bind_param("s", $ma_phong);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updatePhongBan($ma_phong, $ten_phong) {
        $stmt = $this->conn->prepare("UPDATE phongban SET ten_phong = ? WHERE ma_phong = ?");
        $stmt->bind_param("ss", $ten_phong, $ma_phong);
        return $stmt->execute();
    }

    public function deletePhongBan($ma_phong) {
        $stmt = $this->conn->prepare("DELETE FROM phongban WHERE ma_phong = ?");
        $stmt->bind_param("s", $ma_phong);
        return $stmt->execute();
    }
}
?> 