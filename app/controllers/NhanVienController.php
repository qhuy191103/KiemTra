<?php
require_once 'app/models/NhanVienModel.php';
require_once 'app/models/PhongBanModel.php';
require_once 'app/models/UserModel.php';

class NhanVienController {
    private $nhanVienModel;
    private $phongBanModel;
    private $userModel;

    public function __construct() {
        $this->nhanVienModel = new NhanVienModel();
        $this->phongBanModel = new PhongBanModel();
        $this->userModel = new UserModel();
        // Chỉ kiểm tra admin cho các action thêm, sửa, xóa
        if (in_array($this->getCurrentAction(), ['add', 'edit', 'delete'])) {
            $this->checkAdmin();
        }
    }

    private function getCurrentAction() {
        return isset($_GET['action']) ? $_GET['action'] : 'index';
    }

    private function checkAdmin() {
        if (!isset($_SESSION['user_id']) || !$this->userModel->isAdmin($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
        $nhanvien = $this->nhanVienModel->getAllNhanVien();
        require_once 'app/views/nhanvien/list.php';
    }

    public function add() {
        $phongban = $this->phongBanModel->getAllPhongBan();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            if ($this->nhanVienModel->addNhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong)) {
                header("Location: index.php?controller=nhanvien&action=index");
                exit();
            }
        }
        require_once 'app/views/nhanvien/add.php';
    }

    public function edit() {
        $ma_nv = isset($_GET['ma_nv']) ? $_GET['ma_nv'] : null;
        $nhanvien = $this->nhanVienModel->getNhanVienById($ma_nv);
        if (!$nhanvien) {
            die("Không tìm thấy nhân viên!");
        }
        
        $phongban = $this->phongBanModel->getAllPhongBan();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nv = $_POST['ten_nv'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            if ($this->nhanVienModel->updateNhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong)) {
                header("Location: index.php?controller=nhanvien&action=index");
                exit();
            } else {
                die("Có lỗi xảy ra khi cập nhật nhân viên!");
            }
        }
        require_once 'app/views/nhanvien/edit.php';
    }

    public function delete() {
        $ma_nv = isset($_GET['ma_nv']) ? $_GET['ma_nv'] : null;
        if ($this->nhanVienModel->deleteNhanVien($ma_nv)) {
            header("Location: index.php?controller=nhanvien&action=index");
            exit();
        } else {
            die("Có lỗi xảy ra khi xóa nhân viên!");
        }
    }
}
?> 