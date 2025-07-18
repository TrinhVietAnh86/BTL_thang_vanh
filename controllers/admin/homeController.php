<?php
include_once '../models/connect/connect.php';
include_once '../models/product.php';

// controllers/admin/homeController.php
class HomeController {
    private $db;

    // Constructor nhận đối tượng $db
    public function __construct() {
        $this->db = new Product();
    }

    public function home() {
        // Lấy tất cả sản phẩm từ model
        $products = $this->db->getAll();

        // Trả về view với danh sách sản phẩm
        include '../views/font/home.php';
    }
}
?>