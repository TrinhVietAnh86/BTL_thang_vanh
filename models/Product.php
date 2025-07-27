<?php
require_once 'connect/connect.php';

class Product {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Lấy tất cả sản phẩm
    public function getAll()
    {
        $sql = "SELECT sanpham.*, categories.name AS category_name
                FROM sanpham
                LEFT JOIN categories ON sanpham.category_id = categories.id
                ORDER BY sanpham.id DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm mới
    public function add($tensp, $giasp, $anh, $mota, $category_id) {
        $stmt = $this->pdo->prepare("INSERT INTO sanpham (tensp, giasp, anh, mota, category_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$tensp, $giasp, $anh, $mota, $category_id]);
    }

    // Lấy sản phẩm theo ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật sản phẩm
    public function update($id, $tensp, $giasp, $anh, $mota, $category_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Invalid request method for update - ID: $id, Method: " . $_SERVER['REQUEST_METHOD']);
            // Không dùng header trực tiếp trong model, chuyển logic này về controller
            return false;
        }

        // Log dữ liệu nhận được từ form
        error_log("Update product - ID: $id, Tensp: $tensp, Giasp: $giasp, Mota: $mota, Category_id: $category_id");

        // Kiểm tra có upload ảnh mới không
        $ten_anh = $anh; // Sử dụng tham số $anh truyền vào thay vì xử lý file trực tiếp
        if (!empty($_FILES['anh']['name'])) {
            $ten_anh = $_FILES['anh']['name'];
            $tmp_anh = $_FILES['anh']['tmp_name'];
            $duongdan = __DIR__ . '/../../public/image/anhsp/' . $ten_anh;

            if (move_uploaded_file($tmp_anh, $duongdan)) {
                error_log("Image uploaded successfully for product ID: $id, File: $ten_anh");
            } else {
                error_log("Error uploading image for product ID: $id - " . print_r($_FILES['anh'], true));
                return false; // Trả về false nếu upload thất bại
            }
        } else {
            // Không upload ảnh mới, lấy ảnh cũ từ DB
            $product = $this->getById($id); // Sử dụng $this->getById thay vì $this->model->getById
            $ten_anh = $product['anh'] ?? '';
            error_log("Using existing image: $ten_anh for product ID: $id");
        }

        // Cập nhật sản phẩm
        try {
            // Kiểm tra tính hợp lệ của category_id
            if ($category_id !== '') {
                $stmtCheck = $this->pdo->prepare("SELECT COUNT(*) FROM categories WHERE id = ?");
                $stmtCheck->execute([$category_id]);
                if ($stmtCheck->fetchColumn() == 0) {
                    error_log("Invalid category_id: $category_id for product ID: $id");
                    return false;
                }
            }

            $stmt = $this->pdo->prepare("UPDATE sanpham SET tensp = ?, giasp = ?, anh = ?, mota = ?, category_id = ? WHERE id = ?");
            $result = $stmt->execute([$tensp, $giasp, $ten_anh, $mota, $category_id, $id]);
            error_log("SQL executed for product ID: $id - Affected rows: " . $stmt->rowCount());
            return $result;
        } catch (PDOException $e) {
            error_log("Error in update product ID: $id - " . $e->getMessage());
            return false;
        }
    }

    // Xóa sản phẩm
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM sanpham WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Show sản phẩm
    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($user_id, $product_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCartItem) {
            $stmt = $this->pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
            return $stmt->execute([$existingCartItem['id']]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            return $stmt->execute([$user_id, $product_id, 1]);
        }
    }

    // Lấy giỏ hàng của người dùng
    public function getCartByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT c.*, s.tensp, s.giasp, s.anh, s.mota FROM cart c JOIN sanpham s ON c.product_id = s.id WHERE c.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($user_id, $product_id) {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        return $stmt->execute([$user_id, $product_id]);
    }
    // Tìm kiếm sản phẩm theo tên hoặc danh mục
    public function search($keyword) {
        $sql = "SELECT sp.* FROM sanpham sp 
                JOIN categories c ON sp.category_id = c.id 
                WHERE sp.tensp LIKE ? OR c.name LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $search = '%' . $keyword . '%';
        $stmt->execute([$search, $search]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>