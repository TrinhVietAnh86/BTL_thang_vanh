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
                
        }
    ?>