<?php
require_once 'connect/connect.php';
class CategoryModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    // Phương thức hiển thị danh sách sản phẩm
    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM categories ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Phương thức thêm mới form sản phẩm
    public function add($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        return $stmt->execute([$name]);
    }
    //Phương thức lấy dữ liệu 1 sản phẩm
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Cập nhật dữ liêu
    public function update($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE categories SET name=? WHERE id=?");
        return $stmt->execute([$name, $id]);
    }
    //Phương thức Xóa sản phẩm
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }
    // Phương thức tìm kiếm danh mục
    public function search($keyword)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE name LIKE ?");
        $search = "%$keyword%";
        $stmt->execute([$search]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
