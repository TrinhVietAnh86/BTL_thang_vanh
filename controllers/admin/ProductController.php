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
            $anh = $_FILES['anh'];
            $mota = $_POST['mota'];

            if ($this->model->add($tensp, $giasp, $anh, $mota)) {
                header('Location: ./admin.php?controller=product&action=index');
                exit;
            } else {
                echo "Lỗi khi thêm sản phẩm.";
            }
        }
    }
    
    
}

?>