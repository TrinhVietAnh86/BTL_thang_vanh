<?php
include_once __DIR__ . '/../../models/connect/connect.php';
include_once __DIR__ . '/../../models/Product.php';

// controllers/admin/homeController.php
class HomeController {
    private $db;

    public function __construct() {
        $this->db = new Product();
    }
 // Hiển thị trang chủ với danh sách sản phẩm
    public function home() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;
        $products = $this->db->getPaginated($limit, $offset);

        // Lấy tổng số sản phẩm để tính tổng số trang
        $totalProducts = count($this->db->getAll());
        $totalPages = ceil($totalProducts / $limit);

        include __DIR__ . '/../../views/font/home.php';
    }
    // Tìm kiếm sản phẩm
    public function search() {
        $keyword = $_GET['keyword'] ;
        $products = $this->db->search($keyword);
        include __DIR__ . '../../../views/font/search.php';
    }
    // Hiển thị chi tiết sản phẩm
    public function detail($id) {
        $product = $this->db->getById($id);
       include __DIR__ . '/../../views/font/detail.php';    
    }
    //phân trang
    public function paginate($page = 1, $limit = 9) {
        $offset = ($page - 1) * $limit;
        $products = $this->db->getPaginated($limit, $offset);
        include __DIR__ . '/../../views/font/home.php';
    }
}
?>