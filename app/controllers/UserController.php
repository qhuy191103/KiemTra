<?php
require_once 'app/models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        // Nếu đã đăng nhập, chuyển đến trang danh sách
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=nhanvien&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php?controller=nhanvien&action=index');
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                require_once 'app/views/users/login.php';
            }
        } else {
            require_once 'app/views/users/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=user&action=login');
        exit;
    }

    public function checkAdmin() {
        if (!isset($_SESSION['user_id']) || !$this->userModel->isAdmin($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
    }
}
?> 