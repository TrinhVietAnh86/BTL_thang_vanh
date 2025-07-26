<?php
require_once '../models/category.php';
class CategoryController { 
    private $model;

    public function __construct() {
        $this->model = new CategoryModel(); // Sửa lại tên class model
    }

    // Hiển thị danh sách danh mục
    public function index() {
        $categories = $this->model->getAll(); // Đổi tên biến cho đúng ý nghĩa
        include '../views/admin/category/list.php';
    }
    // Thêm danh mục mới
    public function add() { 
        include '../views/admin/category/add.php';
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
    

            if ($this->model->add($name)) {
                header('Location: ./admin.php?controller=category&action=index');
                exit;
            } else {
                echo "Lỗi khi thêm danh mục.";
            }
        }
    }
    // Sửa danh mục
    public function edit($id) {
        $category = $this->model->findById($id);
        if (!$category) {
            echo "Danh mục không tồn tại.";
            return;
        }
        include '../views/admin/category/edit.php';
    }
    public function update($id ) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            if ($this->model->update($id, $name)) {
                header('Location: ./admin.php?controller=category&action=index');
                exit;
            } else {
                echo "Lỗi khi cập nhật danh mục.";
            }
        }
    }
   // Xóa danh mục
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: ./admin.php?controller=category&action=index');
            exit;
        } else {
            echo "Lỗi khi xóa danh mục.";
        }
    }
    
    
    
}
?>