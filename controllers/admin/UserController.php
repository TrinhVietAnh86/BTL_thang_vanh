<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/models/user.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new User();
        error_log("UserController instantiated");
    }

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            error_log("Redirecting from index: No admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $users = $this->model->getAll();
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_list.php';
        error_log("Attempting to include file at absolute path: " . $filePath);
        if (file_exists($filePath)) {
            error_log("File exists at absolute path, attempting to include");
            include $filePath;
        } else {
            error_log("File does not exist at absolute path: " . $filePath);
            echo "File not found: " . $filePath;
        }
    }

    public function add() {
        error_log("UserController::add called");
        include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_add.php';
    }

    public function store() {
        error_log("UserController::store called with POST: " . json_encode($_POST));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($password !== $repassword) {
                $error = "Mật khẩu không khớp!";
                error_log("Store error: Password mismatch");
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_add.php';
                return;
            }

            if ($this->model->checkUserExists($username, $email)) {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                error_log("Store error: Username or email exists");
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_add.php';
                return;
            }

            if ($this->model->register($username, $email, $phone, $address, $password, $role)) {
                error_log("User registered successfully: $username, role: $role");
                header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
                exit;
            } else {
                $error = "Thêm người dùng thất bại!";
                error_log("Store error: Failed to register user");
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_add.php';
            }
        } else {
            $this->add();
        }
    }

    public function edit() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            error_log("Redirecting from edit: No admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $user = $this->model->getById($id);
        if (!$user) {
            $error = "Người dùng không tồn tại!";
            $users = $this->model->getAll();
            include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_list.php';
            return;
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_edit.php';
    }

    public function update() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            error_log("Redirecting from update: No admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $user = $this->model->getById($id);
            if (!$user) {
                $error = "Người dùng không tồn tại!";
                $users = $this->model->getAll();
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_list.php';
                return;
            }

            if ($password && $password !== $repassword) {
                $error = "Mật khẩu không khớp!";
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_edit.php';
                return;
            }

            if ($this->model->checkUserExists($username, $email) && ($username !== $user['username'] || $email !== $user['email'])) {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_edit.php';
                return;
            }

            if ($this->model->update($id, $username, $email, $phone, $address, $password ?: null)) {
                header('Location: /BTL_thang_vanh/public/admin.php?controller=user&action=index');
                exit;
            } else {
                $error = "Cập nhật người dùng thất bại!";
                include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_edit.php';
            }
        } else {
            $this->edit();
        }
    }

    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            error_log("Redirecting from delete: No admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            header('Location: /BTL_thang_vanh/public/admin.php?controller=user&action=index');
            exit;
        } else {
            $error = "Xóa người dùng thất bại!";
            $users = $this->model->getAll();
            include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/admin/user/user_list.php';
        }
    }
}
?>