    <?php
        require_once 'connect/connect.php';
        class Product {
            private $pdo;
    
            public function __construct() {
                $this->pdo = Database::connect();
                
            }
            // Lấy tất cả sản phẩm
            public function getAll() {
                $stmt = $this->pdo->prepare("SELECT * FROM sanpham");
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }
            // Thêm sản phẩm mới
            public function add($tensp, $giasp, $anh, $mota) {
                $stmt = $this->pdo->prepare("INSERT INTO sanpham (tensp, giasp, anh, mota) VALUES (?, ?, ?, ?)");
                return $stmt->execute([$tensp, $giasp, $anh, $mota]);
            }
            // Sửa sản phẩm
            
            // Lấy sản phẩm theo ID
            public function getById($id) {
                $stmt = $this->pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            // Cập nhật sản phẩm
            public function update($id, $tensp, $giasp, $anh, $mota) {
                $stmt = $this->pdo->prepare("UPDATE sanpham SET tensp = ?, giasp = ?, anh = ?, mota = ? WHERE id = ?");
                return $stmt->execute([$tensp, $giasp, $anh, $mota, $id]);
            }
            //xóa sản phẩm
            public function delete($id) {
                $stmt = $this->pdo->prepare("DELETE FROM sanpham WHERE id = ?");
                return $stmt->execute([$id]);
            }

        }
    ?>