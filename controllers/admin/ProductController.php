<?php

require_once '../models/Product.php';

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
                if ($this->model->add($tensp, $giasp, $ten_anh, $mota)) {
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
        if (!$product) {
            echo "Sản phẩm không tồn tại.";
            return;
        }
        include '../views/admin/edit.php';
    }
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tensp = $_POST['tensp'];
            $giasp = $_POST['giasp'];
            $mota = $_POST['mota'];

            // Kiểm tra có upload ảnh mới không
            if (!empty($_FILES['anh']['name'])) {
                $ten_anh = $_FILES['anh']['name'];
                $tmp_anh = $_FILES['anh']['tmp_name'];
                $duongdan = __DIR__ . '/../../public/image/anhsp/' . $ten_anh;

                if (move_uploaded_file($tmp_anh, $duongdan)) {
                    $result = $this->model->update($id, $tensp, $giasp, $ten_anh, $mota);
                } else {
                    echo "Lỗi khi upload ảnh.";
                    return;
                }
            } else {
                // Không upload ảnh mới, lấy ảnh cũ từ DB
                $product = $this->model->getById($id);
                $ten_anh = $product['anh'];
                $result = $this->model->update($id, $tensp, $giasp, $ten_anh, $mota);
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
}

?>