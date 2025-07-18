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
            public function add($tensp, $giasp, $anh, $mota , $category_id) {
                $stmt = $this->pdo->prepare("INSERT INTO sanpham (tensp, giasp, anh, mota,category_id) VALUES (?, ?, ?, ?, ?)");
                return $stmt->execute([$tensp, $giasp, $anh, $mota , $category_id]);
            }
            // Sửa sản phẩm
            
            // Lấy sản phẩm theo ID
            public function getById($id) {
                $stmt = $this->pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            // Cập nhật sản phẩm
            public function update($id, $tensp, $giasp, $anh, $mota, $category_id) {
                $stmt = $this->pdo->prepare("UPDATE sanpham SET tensp = ?, giasp = ?, anh = ?, mota = ? , category_id = ? WHERE id = ?");
                return $stmt->execute([$tensp, $giasp, $anh, $mota, $id , $category_id]);
            }
            //xóa sản phẩm
            public function delete($id) {
                $stmt = $this->pdo->prepare("DELETE FROM sanpham WHERE id = ?");
                return $stmt->execute([$id]);
            }
            //show sản phẩm
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

        }
    ?>