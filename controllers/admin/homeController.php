<?php
include_once __DIR__ . '/../../models/connect/connect.php';
include_once __DIR__ . '/../../models/Product.php';
require_once '../models/category.php';

// controllers/admin/homeController.php
class HomeController {
    private $db;
    private  $categoryModel;

    public function __construct() {
        $this->db = new Product();
        $this->categoryModel = new CategoryModel();
    }
 // Hiển thị trang chủ với danh sách sản phẩm
    public function home() {
        $products = $this->db->getAll();
        $categories = $this->categoryModel->getAll();
        include __DIR__ . '/../../views/font/home.php';
    }
    // Tìm kiếm sản phẩm
    public function search() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $products = $this->db->search($keyword);
        $categories = $this->categoryModel->getAll();
        include __DIR__ . '/../../views/font/search.php';
    }
    // Hiển thị chi tiết sản phẩm
    public function detail($id) {
        $product = $this->db->getById($id);
       include __DIR__ . '/../../views/font/detail.php';    
    }
    
}
?>