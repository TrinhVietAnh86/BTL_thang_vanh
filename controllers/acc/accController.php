<?php
require_once '../models/user.php';

class AccController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Hiển thị form đăng nhập
    public function login() {
        include '../views/acc/login.php';
    }

    // Xử lý đăng nhập
    public function doLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Debug: Ghi log dữ liệu đầu vào
            error_log("doLogin: identifier=$identifier, password=$password");

            if (empty($identifier) || empty($password)) {
                $error = "Vui lòng nhập email và mật khẩu!";
                include '../views/acc/login.php';
                return;
            }

            $user = $this->userModel->login($identifier, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                error_log("Login successful, redirecting user: " . $user['username']);
                if ($user['role'] === 'admin') {
                    header('Location: /BTL_thang_vanh/public/admin.php');
                } else {
                    header('Location: /BTL_thang_vanh/public/indexfull.php');
                }
                exit;
            } else {
                $error = "Sai email hoặc mật khẩu!";
                include '../views/acc/login.php';
            }
        } else {
            include '../views/acc/login.php';
        }
    }

    // Hiển thị form đăng ký
    public function register() {
        include '../views/acc/register.php';
    }

    // Xử lý đăng ký
    public function doRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';

            if ($password !== $repassword) {
                echo$error = "Mật khẩu không khớp!";
                include '../views/acc/register.php';
                return;
            }

            if ($this->userModel->checkUserExists($username, $email)) {
                echo $error = "Tên đăng nhập hoặc email đã tồn tại!";
                include '../views/acc/register.php';
                return;
            }

            $result = $this->userModel->register($username, $email, $phone, $address, $password);

            if ($result) {
                header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
                exit;
            } else {
                echo $error = "Đăng ký thất bại!";
                include '../views/acc/register.php';
            }
        } else {
            echo $error = "Yêu cầu không hợp lệ!";
            include '../views/acc/register.php';
        }
    }

    // Hiển thị thông tin profile
    public function showProfile() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $user = $_SESSION['user'];
        include '../views/acc/profile.php';
    }

    // Xử lý chỉnh sửa profile
    public function doEditProfile() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';

            if ($password && $password !== $repassword) {
                $user = $_SESSION['user'];
                $error = "Mật khẩu không khớp!";
                include '../views/acc/profile.php';
                return;
            }

            if ($this->userModel->checkUserExists($username, $email) && ($username !== $_SESSION['user']['username'] || $email !== $_SESSION['user']['email'])) {
                $user = $_SESSION['user'];
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                include '../views/acc/profile.php';
                return;
            }

            $result = $this->userModel->update($userId, $username, $email, $phone, $address, $password ?: null);

            if ($result) {
                $_SESSION['user'] = $this->userModel->getById($userId);
                $success = "Cập nhật thông tin thành công!";
                $user = $_SESSION['user'];
                include '../views/acc/profile.php';
            } else {
                $user = $_SESSION['user'];
                $error = "Cập nhật thông tin thất bại!";
                include '../views/acc/profile.php';
            }
        } else {
            $this->showProfile();
        }
    }

    // Xóa tài khoản
    public function deleteAccount() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $result = $this->userModel->delete($userId);

        if ($result) {
            session_destroy();
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        } else {
            $user = $_SESSION['user'];
            $error = "Xóa tài khoản thất bại!";
            include '../views/acc/profile.php';
        }
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header('Location: /BTL_thang_vanh/public/indexx.php');
        exit;
    }
}
?>