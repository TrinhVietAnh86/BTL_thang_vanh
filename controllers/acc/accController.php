<?php
require_once '../models/user.php';

class AccController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Hiển thị form đăng nhập
    public function login() {
        $data = ['error' => ''];
        if (isset($_GET['error'])) {
            $data['error'] = "Sai email hoặc mật khẩu!";
        }
        include '../views/acc/login.php';
    }

    // Xử lý đăng nhập
public function doLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifier = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        error_log("doLogin: identifier=$identifier, password=$password");

        if (empty($identifier) || empty($password)) {
            $data = ['error' => 'Vui lòng nhập email và mật khẩu!'];
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
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login&error=1');
            exit;
        }
    } else {
        $this->login();
    }
}

    // Hiển thị form đăng ký
    public function register() {
        $data = ['error' => ''];
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

            if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
                $data = ['error' => 'Vui lòng điền đầy đủ thông tin!'];
                include '../views/acc/register.php';
                return;
            }

            if ($password !== $repassword) {
                $data = ['error' => 'Mật khẩu không khớp!'];
                include '../views/acc/register.php';
                return;
            }

            if ($this->userModel->checkUserExists($username, $email)) {
                $data = ['error' => 'Tên đăng nhập hoặc email đã tồn tại!'];
                include '../views/acc/register.php';
                return;
            }

            $result = $this->userModel->register($username, $email, $phone, $address, $password);

            if ($result) {
                header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
                exit;
            } else {
                $data = ['error' => 'Đăng ký thất bại!'];
                include '../views/acc/register.php';
            }
        } else {
            $data = ['error' => 'Yêu cầu không hợp lệ!'];
            include '../views/acc/register.php';
        }
    }

    // Hiển thị thông tin profile
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $user = $_SESSION['user'];
        $data = ['user' => $user];
        include '../views/acc/profile.php';
    }

    // Hiển thị form chỉnh sửa profile
    public function editProfile() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $user_id = $_SESSION['user']['id'];
        $user = $this->userModel->getById($user_id);
        $data = ['user' => $user, 'error' => '', 'success' => ''];
        include '../views/acc/edit_profile.php';
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
        $role = $_POST['role'] ?? 'user';

        $error = '';
        if (empty($username) || empty($email)) {
            $error = 'Tên đăng nhập và email không được để trống!';
        } elseif (!empty($password) && $password !== $repassword) {
            $error = 'Mật khẩu không khớp!';
        }

        if ($error) {
            $user = $this->userModel->getById($userId);
            $data = ['user' => $user, 'error' => $error];
            include '../views/acc/edit_profile.php';
            return;
        }

        $result = $this->userModel->update($userId, $username, $email, $phone, $address, $password ?: null);

        if ($result) {
            $_SESSION['user'] = $this->userModel->getById($userId);
            $data = ['user' => $_SESSION['user'], 'success' => 'Cập nhật thông tin thành công!'];
            // Chuyển hướng về trang profile sau khi cập nhật thành công
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=profile');
            exit;
        } else {
            $user = $this->userModel->getById($userId);
            $data = ['user' => $user, 'error' => 'Cập nhật thông tin thất bại!'];
        }
        include '../views/acc/edit_profile.php';
    } else {
        $this->editProfile();
    }
}

    // Xóa tài khoản
    public function deleteAccount() {
        if (!isset($_SESSION['user'])) {
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        if ($this->userModel->delete($userId)) {
            session_destroy();
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        } else {
            $user = $_SESSION['user'];
            $data = ['user' => $user, 'error' => 'Xóa tài khoản thất bại!'];
            include '../views/acc/profile.php';
        }
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
        exit;
    }
}