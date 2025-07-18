<?php

require_once '../models/Product.php';
require_once '../models/Category.php'; 

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new Product();
    }

    // Hiển thị danh sách sản phẩm
    public function index() {
        $products = $this->model->getAll();
        include '../views/admin/list.php';
    }

    // Thêm sản phẩm mới
    public function add() {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();
        include '../views/admin/add.php';
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tensp = $_POST['tensp'];
            $giasp = $_POST['giasp'];
            $mota = $_POST['mota'];

            $ten_anh = $_FILES['anh']['name'];
            $tmp_anh = $_FILES['anh']['tmp_name'];
            $duongdan = __DIR__ . '/../../public/image/anhsp/' . $ten_anh;

            if (move_uploaded_file($tmp_anh, $duongdan)) {
                if ($this->model->add($tensp, $giasp, $ten_anh, $mota , $_POST['category_id'])) {
                    header('Location: ./admin.php?controller=product&action=index');
                    exit;
                } else {
                    echo "Lỗi khi thêm sản phẩm.";
                }
            } else {
                echo "Lỗi khi upload ảnh.";
            }
        }
    }
    // Sửa sản phẩm
    public function edit($id) {
        $product = $this->model->getById($id);
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();
        include '../views/admin/edit.php';
    }
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tensp = $_POST['tensp'];
            $giasp = $_POST['giasp'];
            $mota = $_POST['mota'];
            $catId = $_POST['category_id'];

            // Kiểm tra có upload ảnh mới không
            if (!empty($_FILES['anh']['name'])) {
                $ten_anh = $_FILES['anh']['name'];
                $tmp_anh = $_FILES['anh']['tmp_name'];
                $duongdan = __DIR__ . '/../../public/image/anhsp/' . $ten_anh;

                if (move_uploaded_file($tmp_anh, $duongdan)) {
                    $result = $this->model->update($id, $tensp, $giasp, $ten_anh, $mota , $_POST['category_id']);
                } else {
                    echo "Lỗi khi upload ảnh.";
                    return;
                }
            } else {
                // Không upload ảnh mới, lấy ảnh cũ từ DB
                $product = $this->model->getById($id);
                $ten_anh = $product['anh'];
                $result = $this->model->update($id, $tensp, $giasp, $ten_anh, $mota , $_POST['category_id']);
            }

            if ($result) {
                header('Location: ./admin.php?controller=product&action=index');
                exit;
            } else {
                echo "Lỗi khi cập nhật sản phẩm.";
            }
        }
    }
    // Xóa sản phẩm
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: ./admin.php?controller=product&action=index');
            exit;
        } else {
            echo "Lỗi khi xóa sản phẩm.";
        }
    }

    public function addToCart($id) {
        error_log("addToCart: Session check - " . print_r($_SESSION['user'] ?? 'No session', true));
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
            error_log("Redirecting from addToCart: Not a user or admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $id = $_GET['id'] ?? $id; // Lấy ID từ URL
        $user_id = $_SESSION['user']['id'];
        if ($this->model->addToCart($user_id, $id)) {
            error_log("Product added to cart for user ID $user_id: Product ID $id");
        } else {
            error_log("Failed to add product to cart for user ID $user_id");
        }
        header('Location: /BTL_thang_vanh/public/admin.php?controller=product&action=viewCart');
        exit;
    }

    public function viewCart() {
        error_log("viewCart: Session check - " . print_r($_SESSION['user'] ?? 'No session', true));
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
            error_log("Redirecting from viewCart: Not a user or admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $user_id = $_SESSION['user']['id'];
        $cart = $this->model->getCartByUser($user_id);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['giasp'] * $item['quantity'];
        }
        $data = [
            'cart' => $cart,
            'total' => $total
        ];
        include $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/views/user/cart_view.php';
    }

    public function removeFromCart($id) {
        error_log("removeFromCart: Session check - " . print_r($_SESSION['user'] ?? 'No session', true));
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
            error_log("Redirecting from removeFromCart: Not a user or admin session");
            header('Location: /BTL_thang_vanh/public/adminuser.php?controller=acc&action=login');
            exit;
        }
        $id = $_GET['id'] ?? $id;
        $user_id = $_SESSION['user']['id'];
        if ($this->model->removeFromCart($user_id, $id)) {
            error_log("Product removed from cart for user ID $user_id: Product ID $id");
        } else {
            error_log("Failed to remove product from cart for user ID $user_id");
        }
        header('Location: /BTL_thang_vanh/public/admin.php?controller=product&action=viewCart');
        exit;
    }
}