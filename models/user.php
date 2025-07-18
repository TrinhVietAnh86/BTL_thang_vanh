<?php
require_once 'connect/connect.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function checkUserExists($username, $email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function register($username, $email, $phone, $address, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, phone, address, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $phone, $address, $hashedPassword, $role]);
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function update($id, $username, $email, $phone, $address, $password = null) {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ?, password = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $phone, $address, $hashedPassword, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $phone, $address, $id]);
        }
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function login($identifier, $password) {
        // Debug: Ghi log dữ liệu đầu vào
        error_log("Login attempt: identifier=$identifier, password=$password");
        
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();
        
        // Debug: Ghi log kết quả truy vấn
        error_log("User found: " . json_encode($user));
        
        if ($user && password_verify($password, $user['password'])) {
            error_log("Login successful for user: " . $user['username']);
            return $user;
        }
        
        error_log("Login failed: Invalid credentials");
        return false;
    }
}
?>